<?php
		//define('API_ACCESS_KEY','AIzaSyC8iaZMykeh8n0qi6paTe42TY8pSe8RzMs');
		define('API_ACCESS_KEY','AAAAzgKVkb4:APA91bFncEyD6CJGIWdJoOB65gVGjFdD4ZsP1buBi-bszmMfnGDQ7JJzSykdC3B4fQ0UW25NqkQWNDogLMZqsEJlJdTER2ChcW88tFbf3oAZfccNESqxh985JhtQnam056UvtQlurKBz');
		// prep the bundle
		//$msg = array
		//(
			//'message' 	=> $notificationMsg,
			//'title'		=> $title,
		//);
		$msg = $notificationMsg;
		$fields = array
		(
			'registration_ids' 	=> array('dRzgm7bbxGM:APA91bFaRr6CTLEqyra2jD1STBSzHCD9dwBRVPqwMPEdX1H929VDBJICSfBJfIHDgvUsm1QDH9gsyd4006R3yNuDa5Dg20eflqdEzp_wUQ-3N5qEGNGpOHjgauaF2AbCxXeujeWWXpCs'),
			'data'=> array('points'=>"",'message'=> "10 % Off On this occassion" ,'businessId'=>1,'title'=> 'promotion','isFavourite'=> "no")
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
		
		print_r($result);
		print_r($ch);
		die('check');
		//return $result;

	
 ?>
