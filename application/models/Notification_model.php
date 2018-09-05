<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();  
    }
    /*android Notification in fire base*/
    function send_android($registrationIds,$notificationMsg)
    {     
		
	define('API_ACCESS_KEY','AAAAZ-f8KcM:APA91bGsxUOubU6JpgBxNrYGRvv7TZEW30yVZ9AxnoCQPChYKU5XVsArD7HfLECCvFQuHOqn7IQ45VRpSe946ds6eOJQLK-MD8PkyPXJJrsl7m50vnCa-8-3ZT8cIl8VUJIa7ybnlXf6');
		$msg = $notificationMsg;
		$fields = array
		(
			'registration_ids' 	=> $registrationIds,
			'data'			=> $msg
		);
		 
		$headers = array
		(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
		);
		
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		//curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		return $result;
	}//End FUnction
	/*android Notification in fire base*/
	/*Ios 10 notifcation*/
	function ios_send(){
		$production=0;
		
		if ($production) {
		 $gateway = 'gateway.push.apple.com:2195';
		// $deviceToken ='a174f5fdb7d2a9c14965ed01774e9f981ec0439ef6111586baa0b3bc93b64e6a';
		} else { 
		$gateway = 'gateway.sandbox.push.apple.com:2195';
		$deviceToken ='a223bd1060e334be58553efcd66bf9e0bb6f3c3ef509c64a5a22546f44302114';
		}
		$apnsServer = 'ssl://'.$gateway ;
		$privateKeyPassword = 'entrust_root_certification_authority.pem';
		$message = array( "title"=>"Promotion",
		"subtitle"=>"" ,"body"=>"Add multimedia content to your notifications","points"=>"0","businessId"=>1,"isFavourite"=> "no"
		);
		$attrs=array("attachment-url"=>"https://framework.realtime.co/blog/img/ios10-video.mp4");



		///$pushCertAndKeyPemFile = 'WeedRewards.pem';
		$pushCertAndKeyPemFile = 'winAPNS.pem';
		$stream = stream_context_create();
		stream_context_set_option($stream,'ssl','passphrase',$privateKeyPassword);
		stream_context_set_option($stream,'ssl','local_cert',$pushCertAndKeyPemFile);
		$connectionTimeout = 30;
		$connectionType = STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT;
		$connection = stream_socket_client($apnsServer, $errorNumber, $errorString, $connectionTimeout,$connectionType,$stream);

		if (!$connection){
			return "Failed to connect to the APNS server. Error = $errorString <br/>";
		exit;
		}
		else{
		//echo "Successfully connected to the APNS. Processing...</br>";
		}
		$messageBody['aps'] = array('alert' => $message,'badge' => 1, 'sound' => 'default','mutable-content'=>1,'data'=> $attrs);
		$messageBody['data'] = attrs;
		$payload = json_encode($messageBody);
		$notification = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
		$wroteSuccessfully = fwrite($connection, $notification, strlen($notification));

		if (!$wroteSuccessfully){
			return false;		//echo "Could not send the message<br/>";
		} else {
			return true;	//echo "Successfully sent the message<br/>";
		}
	}//ENd Function	
	/*Ios 10 notifcation*/	
} //End CLass

/* End of file notification_model.php */
/* Location: ./application/models/notification_model.php */
