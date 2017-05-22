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
class MemberRegistration{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function adminLogin($adminUser,$adminPass){
		$adminUser = $this->fm->validation($adminUser);
		$adminPass = $this->fm->validation($adminPass);

		$adminUser =mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass =mysqli_real_escape_string($this->db->link, $adminPass);

		if (empty($adminUser) || empty($adminPass)) {
			$loginMsg = "Field must not be empty";
			return $loginMsg;
		}else{
			$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
			$result = $this->db->select($query);

			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("adminlogin", true);
				Session::set("adminId", $value['adminId']);
				Session::set("adminUser", $value['adminUser']);
				Session::set("adminName", $value['adminName']);
				header("Location:dashboard.php");
			}else{
				$loginMsg = "Username or Password not match !";
				return $loginMsg;
			}
		}
	}
}
 ?>