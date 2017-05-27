<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
/**
* Member Registration Class
*/
class MemberLogin{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function memberLogin($data){
		$email 		= $this->fm->validation($data['email']);
		$password 	= $this->fm->validation($data['password']);

		$email 		= mysqli_real_escape_string($this->db->link, $data['email']);
		$password 	= mysqli_real_escape_string($this->db->link, md5($data['password']));

		if (empty($email) || empty($password)) {
			$msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg;
		}

		$query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
		$result = $this->db->select($query);

		if ($result !=false) {
			$value = $result->fetch_assoc();
			Session::set("custLogin", true);
			Session::set("cmrId", $value['id']);
			Session::set("custId", $value['name']);
			Session::set("custemail", $value['email']);
			Session::set("custCountry", $value['country']);
			echo "<script>location.replace('cart.php');</script>";
		}else{
			$msg = "<span class='error'>Email or Password not matched !</span>";
            return $msg;
		}
	}
}
 ?>