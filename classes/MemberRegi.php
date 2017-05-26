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
	    	$to = 'chinmoymondal791@gmail.com';
			$subject = "Password reset security code";

			$message = "
				<html>
					<head>
						<title>Account activation link</title>
					</head>
					<body>
						<p>Click the link for active your account.</p>
						<p>http://localhost/member/User_account_activation_PHP/email_activation.php?$email&code=$confirmCode</p>
					</body>
				</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	    	if (mail($to, $subject, $message,$header)) {
	    		$query = "INSERT INTO tbl_member VALUES('','$name','$email','$g_password','0','$confirmCode')";
	    		$insert_member = $this->db->insert($query);
	    		if ($insert_member) {
               	echo "<script>location.replace('activation.php');</script>";
            }else{
                $msg = "<span class='error'>Member not inserted.</span>";
                return $msg;
            }
	    	}
	    	}
	}

}

 ?>