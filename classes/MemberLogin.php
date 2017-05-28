<?php
	$filepath = realpath(dirname(__FILE__));
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

		if (empty($email) || empty($password)) {
			$msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg;
		}else{

		$query = "SELECT * FROM tbl_member WHERE email='$email' AND password='$password'";
		$result = $this->db->select($query);



		if ($result !=false) {
			$value = $result->fetch_assoc();
			Session::set("memberLogin", true);
			Session::set("m_Id", $value['id']);
			Session::set("m_name", $value['name']);
			Session::set("m_email", $value['email']);
			Session::set("m_activate", $value['activate']);

			$db_activate = $value['activate'];

			if ($db_activate == 1) {
				echo "<script>location.replace('dashboard.php');</script>";
			}else{
				$msg = "<span class='error'>Your account not activated.</span>";
            	return $msg;
			}
			
		}else{
			$msg = "<span class='error'>Email or Password not matched !</span>";
            return $msg;
		}
	}
	}
}
 ?>