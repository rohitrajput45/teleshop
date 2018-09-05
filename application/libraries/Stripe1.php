<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
*/

class Stripe{

	public function __construct () {
		$this->ci =& get_instance();
		$this->ci->config->load('mylib');
		$secret_key = $this->ci->config->item('secret_key');
		$publishable_key = $this->ci->config->item('publishable_key');
		
	}
	
	function createBankToken($country,$currency,$accountHolderName,$accountHolderType,$routingNumber,$accountNo){

		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);

        $bankTok = \Stripe\Token::create(array(
            "bank_account" => array(
                "country" => $country,
                "currency" => $currency,
                "account_holder_name" => $accountHolderName,
                "account_holder_type" => $accountHolderType,
                "routing_number" => $routingNumber,
                "account_number" => $accountNo
            )
        ));

        if(isset($bankTok->id) && !empty($bankTok->id)){
			$data['bankId'] = $bankTok->id;
			
			$b = $this->createCustomerToVerifyBank($bankTok->id);
			$data['customerId'] = $b;
			return $data;
		}else{
			return false;
		}
	}

	function createCustomerToVerifyBank($result){ 

		$customer = \Stripe\Customer::create(array(
                    "description" => "Customer for emily.jones@example.com",
                    "source" => $result
                ));
            
        if(isset($customer->id) && !empty($customer->id) && isset($customer->default_source) && !empty($customer->default_source)){

        	$cus_retrieve = $customer->id;
            $so_retrieve = $customer->default_source;

            $customer = \Stripe\Customer::retrieve($cus_retrieve);
            $bank_account = $customer->sources->retrieve($so_retrieve);

            $res = $bank_account->verify(array('amounts' => array(32, 45)));
            return $customer->id;
        }else{
        	return false;
        }
            
	}
	
	
	
	function save_bank_account_id($holderName,$dob,$country,$currency,$routingNumber,$accountNo,$address,$postalCode,$city,$state,$ssnLast){
       
        if(!empty($holderName)){
            $names = explode(" ", $holderName);
        }
        
        
        $dob = explode("-", $dob);
       
        $secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
         
        $success = 0;
        
		try {
		   $acct = Stripe\Account::create(array(

					"country" => "US",
					"type" => 'custom',
					"external_account" => array(
						"object" => "bank_account",
						"country" => $country,
						"currency" => $currency,
						"routing_number" => $routingNumber,
						"account_number" => $accountNo,
					),
					"tos_acceptance" => array(
						"date" => time(),
						"ip" => $_SERVER['SERVER_ADDR']
					),
				));
				
				$success = 1;
				
		} catch(Stripe_CardError $e) {
		  $error[] = $e->getMessage();
		} catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API
		  $error[] = $e->getMessage();
		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  $error[] = $e->getMessage();
		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		  $error[] = $e->getMessage();
		} catch (Stripe_Error $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		  $error[] = $e->getMessage();
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		  $error[] = $e->getMessage();
		}

		if ($success!=1)	{
			$responseArray = array('status'=>FAIL,'message'=>$error[0]);
			print_r(json_encode($responseArray));die;
			$this->response($responseArray);
		}else{
			$acct_id = $acct->id; 
			$account = Stripe\Account::retrieve($acct_id);
			$account->legal_entity->dob->year = $dob[0];
			$account->legal_entity->dob->month = $dob[1];
			$account->legal_entity->dob->day = $dob[2];
			$account->legal_entity->first_name = $names[0];
			$account->legal_entity->last_name = $names[1];
			$account->legal_entity->type = "individual";
			$account->legal_entity->address->line1 = $address;
			$account->legal_entity->address->postal_code = $postalCode;
			$account->legal_entity->address->city = $city;
			$account->legal_entity->address->state = $state;
			$account->legal_entity->ssn_last_4 = $ssnLast;
			$account->save();
		   if(isset($acct->id) && !empty($acct->id)){
				return $acct->id;
			}else{
				return false;
			}
		}
    }
	
	function addCardAccount($name,$number,$exp_month,$exp_year,$cvv){
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		$success = 0;
		try {
		   $result = Stripe\Token::create(
				array(
				"card" => array(
					"number" => $number,
					"exp_month" => $exp_month,
					"exp_year" => $exp_year,
					"cvc" => $cvv
					) 
				)
			); 	
		$success = 1;
		} catch(Stripe_CardError $e) {
		  $error[] = $e->getMessage();
		} catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API
		  $error[] = $e->getMessage();
		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  $error[] = $e->getMessage();
		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		  $error[] = $e->getMessage();
		} catch (Stripe_Error $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		  $error[] = $e->getMessage();
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		  $error[] = $e->getMessage();
		}

		if ($success!=1)	{
			$responseArray = array('status'=>FAIL,'message'=>$error[0]);
			print_r(json_encode($responseArray));die;
			$this->response($responseArray);
		}else{
			if(isset($result['id']) && !empty($result['id'])){
				return $result['id'];
			}else{
				return false;
			}     
		}
	}
	
	function pay_by_bank_id($acctId,$payment){ ////////// bank to stripe
		
/*
		$secret_key = $this->ci->config->item('secret_key');
		Stripe\Stripe::setApiKey($secret_key);

		$transfer = \Stripe\Charge::create(array( 
			"amount" => $payment, 
			"currency" => "USD", 
			"description" => $payment, 
			"source" => $acctId, 

		));
		return $transfer;
*/
		
		
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		$success = 0;
		try {
			
			$transfer = \Stripe\Charge::create(array( 
				"amount" => $payment, 
				"currency" => "USD", 
				"description" => $payment, 
				"source" => $acctId, 
			));
			
			
		$success = 1;
		} catch(Stripe_CardError $e) {
		  $error[] = $e->getMessage();
		} catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API
		  $error[] = $e->getMessage();
		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  $error[] = $e->getMessage();
		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		  $error[] = $e->getMessage();
		} catch (Stripe_Error $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		  $error[] = $e->getMessage();
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		  $error[] = $e->getMessage();
		}

		if ($success!=1)	{
			$responseArray = array('status'=>FAIL,'message'=>$error[0]);
			print_r(json_encode($responseArray));die;
			$this->response($responseArray);
		}else{
			return $transfer;
		}
	}
	
	function pay_by_stripe_id($acctId,$payment){ ////////// bank to stripe
/*
		$secret_key = $this->ci->config->item('secret_key');
		Stripe\Stripe::setApiKey($secret_key);
		$transfer = \Stripe\Transfer::create(array( 
					"amount" => $payment, 
					"currency" => "USD", 
					"destination" => $acctId, 
		));
*/
		
		
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		$success = 0;
		try {
		 $transfer = \Stripe\Transfer::create(array( 
			"amount" => $payment, 
			"currency" => "USD", 
			"destination" => $acctId, 
			 "source_type" => "bank_account",
		));
		$success = 1;
		} catch(Stripe_CardError $e) {
		  $error[] = $e->getMessage();
		} catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API
		  $error[] = $e->getMessage();
		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  $error[] = $e->getMessage();
		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		  $error[] = $e->getMessage();
		} catch (Stripe_Error $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		  $error[] = $e->getMessage();
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		  $error[] = $e->getMessage();
		}

		if ($success!=1)	{
			$responseArray = array('status'=>FAIL,'message'=>$error[0]);
			print_r(json_encode($responseArray));die;
			$this->response($responseArray);
		}else{
			return $transfer;
		}
	}
	
    function save_card_id($email = '',$token = ''){
		
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		
		$customer = Stripe\Customer::create(array(
		  "email" => $email, 
		  "source" => $token,
		));
		
		if(isset($customer->id) && !empty($customer->id)){
			return $customer->id;
		}else{
			return false;
		}
	}
	
	function pay_by_card_id($payment,$custId){
	
/*
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		
		$charge = Stripe\Charge::create(array(
		  "amount" => $payment, 
		  "currency" => "usd",
		  "customer" => $custId
		));
		
		return $charge;
*/
		
		
		
		
		
		
		
		$secret_key = $this->ci->config->item('secret_key');
        Stripe\Stripe::setApiKey($secret_key);
		$success = 0;
		try {
			$transfer = Stripe\Charge::create(array(
			  "amount" => $payment, 
			  "currency" => "usd",
			  "customer" => $custId
			));
			$success = 1;
		} catch(Stripe_CardError $e) {
		  $error[] = $e->getMessage();
		} catch (Stripe_InvalidRequestError $e) {
		  // Invalid parameters were supplied to Stripe's API
		  $error[] = $e->getMessage();
		} catch (Stripe_AuthenticationError $e) {
		  // Authentication with Stripe's API failed
		  $error[] = $e->getMessage();
		} catch (Stripe_ApiConnectionError $e) {
		  // Network communication with Stripe failed
		  $error[] = $e->getMessage();
		} catch (Stripe_Error $e) {
		  // Display a very generic error to the user, and maybe send
		  // yourself an email
		  $error[] = $e->getMessage();
		} catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		  $error[] = $e->getMessage();
		}

		if ($success!=1)	{
			$responseArray = array('status'=>FAIL,'message'=>$error[0]);
			print_r(json_encode($responseArray));die;
			$this->response($responseArray);
		}else{
		
			return $transfer;
		}
		
	}
	
	function refund_payment($cd){
		
		$secret_key = $this->ci->config->item('secret_key');
				
        Stripe\Stripe::setApiKey($secret_key);
		
		$charge =  Stripe\Charge::retrieve($cd,array('api_key' => $secret_key));
		
		return $charge;
	}
}
