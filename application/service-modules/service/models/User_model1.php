<?php
class User_model extends CI_Model {

	function logout(){
    	$this->db->where('id',$this->authData->id);
		$update=$this->db->update('users',array('deviceToken' =>''));

		if ($update) {
			$this->db->where('userId',$this->authData->id);
			$this->db->update('driverDetail',array('duty' =>0));
				return true;
		} else {
				return false;
		}
    }//End FUnction 
    //Update 
	function updateRow($table,$where,$set){
		
		$this->db->where($where);
		$update=$this->db->update($table,$set);
		return $update;
	}//ENd FUnction  
	function dutyCheck(){
		$duty=0;
		$sql = $this->db->select("duty")->where(array('userId'=>$this->authData->id))->get('driverDetail');
		if($sql->num_rows()){
			$user = $sql->row();
			$duty = $user->duty ? 0:1;
		}
		$this->db->where('userId',$this->authData->id);
			$update=$this->db->update('driverDetail',array('duty' =>$duty));
		if ($update) {
			$status = $duty  ? 'ON':'OFF';
			return array('status'=>$duty);
		} else {
			return false;
		}
    }//End FUnction
   function getUser($table,$select="*",$where=array()){
		$this->db->select($select)->from($table);
		!empty($where) ?$this->db->where($where):'';
		$sql = $this->db->get();
		if($sql->num_rows()){
			$user = $sql->row();
			$image = $user->profileImage;
			if(!empty($image)):
				$user->profileImage = base_url().'uploads/profile/resize/'.$image;
				$user->profile = base_url().'uploads/profile/'.$image;
			
			endif; 
			$userDetail 	= $this->userDetail($user->id);
			$user ->onDuty 	= 0;
			if($userDetail){
				$user ->onDuty 	= $userDetail->duty;
			}
			
			
			return $user;
		}
		return false;
	}//ENd function
	function userDetail($userId){
		
		$this->db->select("*")->from('driverDetail');
		$this->db->where(array('userId'=>$userId));
		$sql = $this->db->get();
		if($sql->num_rows()){
			$detail = $sql->row();
			$licenseImage = $detail->licenseImage;
			if(!empty($licenseImage)):
			
				$detail->licenseImage = base_url().'uploads/license/resize/'.$licenseImage;
			
			endif; 
			return $detail;
		}
		return false;
	}//ENd FUnction
	function deliveryRequest($deliveryId,$status){

		$sql = $this->db->select('*')->where(array('id'=>$deliveryId,'driverId'=>$this->authData->id))->get('assignDelivery');
		if($sql->num_rows()){
			if($status=='accept'){
				$this->db->where(array('id'=>$deliveryId));
				$update = $this->db->update('assignDelivery',array('requestStatus'=>1));
				if($update){
					return array('status'=>'accept','message'=>"Delivery Accepted.");
				}

			}elseif ($status=='reject') {
				$this->db->where(array('id'=>$deliveryId));
				$update = $this->db->update('assignDelivery',array('requestStatus'=>0,'driverId'=>0));
				if($update){
					return array('status'=>'reject','message'=>"Delivery Rejected.");
				}
			}

		}
		return false;
	}//End Function
	function  deliveryInfo($deliveryId,$orderId){
		$responce = new stdClass();
		$where['driverId'] =  $this->authData->id;
	//	$where['requestStatus'] 	=  0;
		$where['deliveryStatus'] 	=  0;
		if(!empty($deliveryId)){
			$where['id'] =  $deliveryId;
		}
		if(!empty($orderId)){
			$where['orderId'] =  $orderId;
		}
		$sql = $this->db->select('*')->where($where)->get('assignDelivery');
		if($sql->num_rows()){
			$delivery = $sql->row();
			/*basic info */
			$deliveryId 		= $delivery->id;
			$orderId 			= $delivery->orderId;
			$quantity 			= $delivery->quantity;
			$unitType 			= $delivery->unitType;;
			$subOrderId 		= $delivery->subOrderId;
			$officeId 			= $delivery->officeId;
			$pitId 				= $delivery->pitId;
			$productId 			= $delivery->productId;
			$totalShift 		= $delivery->totalShift;
			$completeShift 		= $delivery->completeShift;
			$unLoadTruck 		= $delivery->unLoadTruck;
			$loadTruck 			= $delivery->loadTruck;
			$requestStatus 		= $delivery->requestStatus;
			$deliveryStatus  	= $delivery->deliveryStatus;
			$deliveryDistance  	= 0;
			$invoiceOrderId		= $delivery->invoiceId."/".$subOrderId."/".$deliveryId;
			
			if(!empty($unLoadTruck)){
				$unLoadTruck 	= base_url().'uploads/trucks/resize/'.$unLoadTruck;
			}
			if(!empty($loadTruck)){
				$loadTruck 		= base_url().'uploads/trucks/resize/'.$loadTruck;
			}
			/* basic info*/
			$suborderInfo =$this->commonDetail('orderProduct',array('id'=>$subOrderId),'deliveryDistance,pitPayStatus,pitPay,unitTypeId');
			 $pitPay = array();
			 $pitPayStatus= 0;
			if(!empty($suborderInfo)):
				$unitType = $this->commonDetail('unitType',array('id'=>$suborderInfo->unitTypeId),'unitType')->unitType;
			 $deliveryDistance = $suborderInfo->deliveryDistance;
			 $pitPay 		= json_decode($suborderInfo->pitPay,true);
			 $pitPayStatus 	= $suborderInfo->pitPayStatus;
			 if(!empty($pitPay)){
			 	 $pitPay = $this->setPayData($pitPay);
			 }
			endif;
			//$subOrderId
			/* order info*/
				$orderSelect="contactName as customerName,phoneNumber as customerPhoneNumber,customerEmail,billingAddressType,billingAddress,poBoxNumber,city,zipcode,deliveryAddress,deliveryLatitude,deliveryLongitude,paymentMode,totalPrice as totalAmount";
				$orderInfo=$this->commonDetail('customerOrder',array('id'=>$orderId),$orderSelect);
				$orderInfo->deliveryDistance = $deliveryDistance;
			/* order info*/
			/* pit info*/
			$pitSelect="companyName as pitName,phoneNumber as pitContact,address as pitAddress,latitude as pitLatitude ,longitude as pitLongitude";
				$pitInfo=$this->commonDetail('pits',array('id'=>$pitId),$pitSelect);
				 $pitInfo->pitPay = $pitPay;
				 $pitInfo->pitPayStatus = $pitPayStatus;
			/* pit info*/
			/* product info*/
				$productSelect ="name as productName";
				$productInfo =$this->commonDetail('product',array('id'=>$productId),$productSelect);
				$productInfo->quantity = $quantity;
				$productInfo->unitType = $unitType;
			/* product info*/

			/*responce*/
			$responce->deliveryId 		= $deliveryId;
			$responce->invoiceOrderId 	= $invoiceOrderId;
			$responce->order 			= $orderId;
			$responce->subOrderId 		= $subOrderId;
			$responce->totalShift		= $totalShift;
			$responce->completeShift	= $completeShift;
			$responce->requestStatus 	= $requestStatus;
			$responce->deliveryStatus 	= $deliveryStatus;
			$responce->orderInfo 		= $orderInfo;
			$responce->pitInfo 			= $pitInfo;
			$responce->productInfo 		= $productInfo;
			/*responce*/
			//$responce = $delivery;
		}//End FUnction
		return $responce;
	}//End FUnction
	
    function commonDetail($table,$where,$select="*"){
    	$responce = new stdClass();
    	$sql = $this->db->select($select)->from($table)->where($where)->get();
    	if($sql->num_rows()){
    		$responce = $sql->row();
    	}
    	return $responce;
    }//End Function
    function moneyFromManager($moneyFromManager){
		$where['userId'] =  $this->authData->id;
		$sql = $this->db->select("*")->from("driverDetail")->where($where)->get();
		if($sql->num_rows()){
			$detail = $sql->row();
			$money  = $detail->moneyFromManager; 
			$total  = $money + $moneyFromManager;
			$update = $this->db->where(array('id'=>$detail->id))->update('driverDetail',array('moneyFromManager'=>$total));
			if($update){
				$res = $this->dailyReport($where,$moneyFromManager);
				return array('message'=>"successfully done.",'res'=>$res); 	
			}
		}
		return false;
	}//ENd Function
	function dailyReport($where,$moneyFromManager){
		$data_val = array();
		$Reportdate = date("Y-m-d");
		$where1['driverId'] = $where['userId'];
		$where1['dateOfReport'] = $Reportdate;
		$sql = $this->db->select("*")->from("dailyReport")->where($where1)->get();
		if($sql->num_rows()){
			$check = $sql->row();
			$other  = !empty($check->report) ? json_decode($check->report,true) :array();
			if ($moneyFromManager > 0) {
				$data_val['moneyAddManager'] 	= $check->moneyAddManager + $moneyFromManager;
				//~ if(!empty($check->moneyReturnDriver)){
					//~ $data_val['moneyReturnDriver'] 	= $check->moneyReturnDriver + $moneyFromManager;
				//~ }
				array_push($other,array('moneyAddManager'=>$moneyFromManager,'date'=> date("Y-m-d H:i:s")));
			}else{
				$data_val['moneyAddManager'] 	= $check->moneyAddManager + $moneyFromManager;
				$data_val['moneyReturnDriver'] 	= $check->moneyReturnDriver + $moneyFromManager;
				array_push($other,array('moneyReturnDriver'=>$moneyFromManager,'date'=> date("Y-m-d H:i:s")));
			}
			$data_val['report'] 	= !empty($other) ? json_encode($other) :'';
			$update = $this->db->where(array('id'=>$check->id))->update('dailyReport',$data_val);
			return  $update ? 1 : 0;
			
		}else{
			$other = array();
			$data_val['driverId'] = $where['userId'];
			if ($moneyFromManager > 0) {
				$data_val['moneyAddManager'] =$moneyFromManager;
				array_push($other,array('moneyAddManager'=>$moneyFromManager,'date'=> date("Y-m-d H:i:s")));
			}else{
				$data_val['moneyReturnDriver'] = $moneyFromManager;
				array_push($other,array('moneyReturnDriver'=>$moneyFromManager,'date'=> date("Y-m-d H:i:s")));
			}
			$data_val['report'] 	= !empty($other) ? json_encode($other) :'';
			$data_val['dateOfReport'] 	= $Reportdate;
			$data_val['crd'] 			= date("Y-m-d H:i:s");
			
			$this->db->insert("dailyReport",$data_val);
			return $this->db->insert_id();
		}//Endif
		return false;
		
	}//end FUnction
	function getdailyReport($dateOfReport){
		$responce = new stdClass();
		$where['driverId'] =  $this->authData->id;
		$where['dateOfReport'] =  $dateOfReport;
		$detail=  $this->commonDetail('driverDetail',array('userId'=>$this->authData->id),$select="*");
		$responce->moneyFromManager  = $detail->moneyFromManager;
		$sql = $this->db->select("moneyAddManager,moneyReturnDriver,numberOfDelivery,numberofLoading,report,dateOfReport")->from("dailyReport")->where($where)->get();
		if($sql->num_rows()){
			$check = $sql->row();
			$check->report  = !empty($check->report) ? json_decode($check->report,true) :array();
				$check->moneyFromManager  = $detail->moneyFromManager;
			$responce = $check ;
		}else{
			$responce->moneyAddManager 		= 0;
			$responce->moneyReturnDriver 	= 0;
			$responce->numberOfDelivery 	= 0;
			$responce->numberofLoading 		= 0;
			$responce->report 				= array();
			$responce->dateOfReport 		= $dateOfReport;	
		}
		return $responce;
	}//ENd Function
	function pitPayment($subOrderId,$paymentMode,$paymentType,$amount,$receiptImage,$description=""){
		/* basic info*/
			$suborderInfo =$this->commonDetail('orderProduct',array('id'=>$subOrderId),'deliveryDistance,pitPayStatus,pitPay');
			 $pitPay = array();
			 $pitPayStatus= 0;
			if(!empty($suborderInfo)):
				$pitPayStatus 	= $suborderInfo->pitPayStatus;
				if($pitPayStatus == 0){
					$payinfo = $paid = array();	
					$pitPay 		= json_decode($suborderInfo->pitPay,true);
					$totalAmount 	= $pitPay['totalAmount'];
					$dueAmount 		= $pitPay['dueAmount'];
					$payinfo  		= !empty($pitPay['pay']) ? $pitPay['pay']:array();
					$paid['driverId'] 	 =  $this->authData->id;
					$paid['driverName']  =  $this->authData->fullName;
					$paid['paymentType'] =  $paymentType;
					$paid['paymentMode'] =  $paymentMode;
					$paid['amount'] 	 =  $amount;
					$paid['receipt'] 	 =  $receiptImage;
					$paid['description']  = $description;
					$paid['createDate']  =  date("Y-m-d H:i:s");
					array_push($payinfo,$paid);
					$status = 0;
					$remaning = $dueAmount - $amount;
					$status  = ($remaning==0) ? 1 :0;
					$setData = array('totalAmount'=>$totalAmount,'dueAmount'=>$remaning,'pay'=>$payinfo);
					$update = $this->db->where(array('id'=>$subOrderId))->update('orderProduct',array('pitPayStatus'=>$status,'pitPay'=>json_encode($setData)));
					if($update){
						$rr = "-".$amount;
						$this->moneyFromManager($rr);
						return array('message'=>"Pit payment paid successfully done.",'data'=>$setData);
					}

				}else{
					return array('message'=>"Pit payment already paid.",'data'=>array());
				}
			endif;
			return false;
	}//ENd function
	
	function customerPayment($orderId,$paymentMode,$paymentType,$amount,$receiptImage,$description=""){
		/* basic info*/
			$orderInfo =$this->commonDetail('customerOrder',array('id'=>$orderId,'paymentMode'=>"COD",'paymentStatus'=>0),'paymentStatus,customerPay');
			 $customerPay = array();
			 $paymentStatus= 0;
			if(!empty($orderInfo)):
				$paymentStatus 	= $orderInfo->paymentStatus;
				if($paymentStatus == 0){
					$payinfo = $paid = array();	
					$customerPay 		= json_decode($orderInfo->customerPay,true);
					$totalAmount 	= $customerPay['totalAmount'];
					$dueAmount 		= $customerPay['dueAmount'];
					$payinfo  		= !empty($customerPay['pay']) ? $customerPay['pay']:array();
					$paid['driverId'] 	 =  $this->authData->id;
					$paid['driverName']  =  $this->authData->fullName;
					$paid['paymentType'] =  $paymentType;
					$paid['paymentMode'] =  $paymentMode;
					$paid['amount'] 	 =  $amount;
					$paid['receipt'] 	 =  $receiptImage;
					$paid['description']  = $description;
					$paid['createDate']  =  date("Y-m-d H:i:s");
					array_push($payinfo,$paid);
					$status = 0;
					$remaning = $dueAmount - $amount;
					$status  = ($remaning==0) ? 1 :0;
					$setData = array('totalAmount'=>$totalAmount,'dueAmount'=>$remaning,'pay'=>$payinfo);
					$update = $this->db->where(array('id'=>$orderId))->update('customerOrder',array('paymentStatus'=>$status,'customerPay'=>json_encode($setData)));
					if($update){
						//$rr = "-".$amount;
						//$this->moneyFromManager($rr);
						return array('message'=>"Customer payment paid successfully done.",'data'=>$setData);
					}

				}else{
					return array('message'=>"Customer payment already paid.",'data'=>array());
				}
			endif;
			return false;
	}//ENd function
	
	function setPayData($pitPay){
		//print_r($pitPay['pay']);die;
		if(!empty($pitPay['pay'])):
			$p = $pitPay['pay'];
			for ($i=0; $i <sizeof($p) ; $i++) { 
			
			if(!empty($p[$i]['receipt'])):
				$img = $p[$i]['receipt'];
				$p[$i]['receipt'] = base_url()."uploads/receipt/".$img;

			endif;
			}
			$pitPay['pay']=$p;
		endif;
		//print_r($pitPay);die;
		return $pitPay;
	}//End FUnction
	function deliveryReport($deliveryId,$shiftNumber,$reportType,$reportImage){
		$res =0;
		$date 			= date("Y-m-d H:i:s");
		$sql = $this->db->select("*")->from("assignDelivery")->where(array('id'=>$deliveryId))->get();
		if($sql->num_rows()):
			$done = 0;
			$report = $sql->row();
			$totalShift 	= $report->totalShift;
			$completeShift  = $report->completeShift;
			$deliveryStatus = $report->deliveryStatus;
			$subOrderId  	= $report->subOrderId;
			$shiftReport  	= !empty($report->shiftReport) ? json_decode($report->shiftReport,true) : array() ;
			//print_r($shiftReport);die;
			$tshift = $shiftNumber-1;
			$resReport = $shiftReport[$tshift];
			if(!empty($resReport)):
				
				//print_r($resReport);die("fdxfg");
				switch ($reportType) {
					case 'beforeDelivery':
						$resReport['beforeDelivery']['image'] 	= $reportImage;
						$resReport['beforeDelivery']['crd'] 	= $date;
						$resReport['status']                    = "Processing";
					//	print_r($resReport);
						break;
					case 'afterDelivery':
						$resReport['afterDelivery']['image'] 	= $reportImage;
						$resReport['afterDelivery']['crd'] 		= $date;
						$resReport['status']                    = "Processing";
						break;
					case 'deliveryReceipt':
						$resReport['deliveryReceipt']['image'] 	= $reportImage;
						$resReport['deliveryReceipt']['crd'] 	= $date;
						$resReport['status']                    = "Complete";
						$done =1;
						break;
					
					default:
						$res=0;
						break;
				}
				

			 $shiftReport[$tshift] = $resReport;
			 //$completeShift  = 	
			endif;// checl
			if(!empty($shiftReport)){
					if($done){
 						$completeShift  = $completeShift+1;
						if($totalShift==$completeShift){
							$deliveryStatus = 2;
						}
					}else{
						$deliveryStatus =1;
					}
				$update = $this->db->where(array('id'=>$deliveryId))->update('assignDelivery',array('shiftReport'=>json_encode($shiftReport),'completeShift'=>$completeShift,'deliveryStatus'=>$deliveryStatus));
				if($update){
					if($deliveryStatus==2){
						$this->sectionCheck($subOrderId,1);
						
					}
				}
				return $update ? array('message'=>"successfully done",'data'=>$shiftReport):0;
				

			}
			//print_r($shiftReport);die;
		endif;
		return $res;
	}//End Function
	function sectionCheck($subOrderId,$section){
		$check = $this->db->select("*")->where(array('id'=>$subOrderId))->get('orderProduct');
	//	echo $this->db->last_query();die;
		if($check->num_rows()){
			$sec = $check->row();
			$totalSection 	 	= $sec->totalSection;
			$orderId 	 	= $sec->orderId;
			$completeSection 	= $sec->completeSection;
			$deliveryStatus 	= $sec->deliveryStatus;
			$completeSection 	= $completeSection + $section;
			if($totalSection == $completeSection){
				$deliveryStatus 	= 2;
			}else{
				$deliveryStatus 	= 1;
			}
			
			$u = $this->db->where(array('id'=>$subOrderId))->update('orderProduct',array('completeSection'=>$completeSection,'deliveryStatus'=>$deliveryStatus));
			if($u && $deliveryStatus==2){
				$this->orderCheck($orderId);
			}
		}
		return true;
	}//ENd 
	function orderCheck($orderId){
		$check = $this->db->select("*")->where(array('orderId'=>$orderId))->get('orderProduct');
	//	echo $this->db->last_query();die;
		
		if($check->num_rows()){
			$section = $check->result();
			$deliveryStatus 	= 1;
			$ordercheck = array();
			foreach ($section as $key => $sec) {
				$totalSection 	 	= $sec->totalSection;
				$completeSection 	= $sec->completeSection;
				//$deliveryStatus 	= $sec->deliveryStatus;
				//$completeSection 	= $completeSection + $section;
				if($totalSection == $completeSection){
					array_push($ordercheck,1);
				//$deliveryStatus 	= 2;
				}else{
					array_push($ordercheck,0);
				//$deliveryStatus 	= 1;
				}
				
			}
			if(!empty($ordercheck) && !in_array(0, $ordercheck)){
				$deliveryStatus 	= 2;
			}
			$u = $this->db->where(array('id'=>$orderId))->update('customerOrder',array('orderStatus'=>$deliveryStatus));
		}
		return true;
	}//ENd 

}//End Class
?>
