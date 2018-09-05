<?php
class Email_model extends CI_Model
{
	
	
	function mailSend($emailto,$message,$subject,$data,$path,$check){
		$url = base_url().FRONT_THEME."/images/";
		if($check):
		$url = base_url().ADMIN_THEME."/assets/img/";
		endif;
		$this->load->library('email');
		$config = array();
		$config['useragent'] = "CodeIgniter";
		$config['mailpath']  = "/usr/sbin/mail"; 
		$config['protocol']  = "mail";//sendmail
		$config['smtp_host'] = "165.227.190.43";
		$config['smtp_port'] = "25";
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";
		$config['wordwrap']  = TRUE;
		
		$this->email->initialize($config);
		$this->email->from('noreply@sandnsoil.com', 'SandnSoil');
		$this->email->to($emailto);
		$this->email->subject($subject);
		$data['contant']= $message;
		$data['base_url']= $url;
		$body = $this->load->view($path,$data,TRUE);
		$this->email->message($body);
		if ($this->email->send()) {	
			return  array('emailType'=>'ES','email'=>'The email has successfully been sent!!' ); //ES emailSend
		}else{
			return  array('emailType'=>'NS','email'=> show_error($this->email->print_debugger())) ; //NS NOSend
		}
	}//ENd Function
	
}//End Class
?>
