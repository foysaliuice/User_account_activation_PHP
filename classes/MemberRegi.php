<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
 ?>
<?php 

class MemberRegi{
	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function PasswordGenerator($length){
		if (is_numeric($length) && (!is_null($length)) && ($length > 0)) {
			$password = '';
			$keyCombi = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
			srand((int) ((double) microtime()* 1000003));
			for ($i=0; $i <= $length ; $i++) { 
				$randomize = rand(0, (strlen($keyCombi)));
				$password .= $keyCombi[$randomize];
			}
			return $password;
		}
	}

	public function MemberRegistration($name, $email){
		$name 	= $this->fm->validation($name);
		$email 	= $this->fm->validation($email);
		$name 	= mysqli_real_escape_string($this->db->link, $name);
		$email 	= mysqli_real_escape_string($this->db->link, $email);

		$confirmCode = rand();
		$g_password = $this->PasswordGenerator(12);

	    if ($name == "" || $email == "") {
	    	$msg = "<span class='error'>Fields must not be empty.</span>";
                return $msg;
	    }else{

	    	//Send activation email
	    	$to = 'webtutor24hrs@gmail.com';
			$subject = "Account Activation Email";

			$message = "
				<html>
					<head>
						<title>Account activation link</title>
					</head>
					<body>
						<p>Your login ID: $email</p>
						<p>Your login password: $g_password</p>
						<p>Click the link to activate your account.</p>
						<p>http://localhost/member/User_account_activation_PHP/email_activation.php?email=$email&code=$confirmCode</p>
					</body>
				</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	    	if (mail($to, $subject, $message,$headers)) {
	    		$mailquery = "SELECT * FROM tbl_member WHERE email='$email' LIMIT 1";
	    		$mailchk = $this->db->select($mailquery);

	    			if ($mailchk != false) {
	    				$msg = "<span class='error'>Email already registered.</span>";
                		return $msg;
	    			}else{
	    				$query = "INSERT INTO tbl_member VALUES('','$name','$email','$g_password','0','$confirmCode')";
			    		$insert_member = $this->db->insert($query);
			    		if ($insert_member) {
		               
		               		$msg="Your registration successful. Please check <b>'$email'</b> for activate your account.";
		               		return $msg;
		            }else{
		                $msg = "<span class='error'>Member not inserted.</span>";
		                return $msg;
		            }
	    			}
	    		
	    	}
	    	}
	}

	public function EmailActivation($email, $code){
		$db_code="";
		$query = "select * from tbl_member where email='$email'";
		$result = $this->db->select($query);

		if ($result !=false) {
			$value = $result->fetch_assoc();
			$db_code = $value['code'];

			if ($code == $db_code) {
			$update = "update tbl_member set activate='1', code='0' where email='$email'";
			$result = $this->db->update($update);
			$msg = "Account activated";
			return $msg;
			}else{
			$msg = "<span class='error'>Email or code not match<br><br></span>";
			return $msg;
		}
		}
	}
}

 ?>