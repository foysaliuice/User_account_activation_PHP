<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
 ?>
<?php
class Customer{

	private $db;
	private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function customerRegistration($data){
		$salutation = $this->fm->validation($data['salutation']);
		$gender = $this->fm->validation($data['gender']);
		$fname 		= $this->fm->validation($data['fname']);
		$lname 		= $this->fm->validation($data['lname']);
		$email 		= $this->fm->validation($data['email']);
		$password 	= $this->fm->validation($data['password']);
		$phone 		= $this->fm->validation($data['phone']);
		$address 	= $this->fm->validation($data['address']);
		$city 		= $this->fm->validation($data['city']);
		$country 	= $this->fm->validation($data['country']);
		$zip 		= $this->fm->validation($data['zip']);
		$state 		= $this->fm->validation($data['state']);


		$salutation 		= mysqli_real_escape_string($this->db->link, $data['salutation']);
		$gender 		= mysqli_real_escape_string($this->db->link, $data['gender']);
		$fname 		= mysqli_real_escape_string($this->db->link, $data['fname']);
		$lname 		= mysqli_real_escape_string($this->db->link, $data['lname']);
		$email 		= mysqli_real_escape_string($this->db->link, $data['email']);
		$password 	= mysqli_real_escape_string($this->db->link, md5($data['password']));
		$phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
		$address 	= mysqli_real_escape_string($this->db->link, $data['address']);
		$city 		= mysqli_real_escape_string($this->db->link, $data['city']);
		$country 	= mysqli_real_escape_string($this->db->link, $data['country']);
		$zip 		= mysqli_real_escape_string($this->db->link, $data['zip']);
		$state 		= mysqli_real_escape_string($this->db->link, $data['state']);



		if ($salutation == "" || $gender=="" || $fname == "" || $lname=="" || $email == "" || $password == ""||$phone == "" ||$address==""|| $city == "" || $country == "" || $zip == "" ||$state == "") {
	    	$msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg;
	    }
	    $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
	    $mailchk = $this->db->select($mailquery);

	    if ($mailchk !=false) {
	    	$msg = "<span class='error'>Emial already Exists.</span>";
            return $msg;
	    }else{
	    	$query = "INSERT INTO tbl_customer(salutation,gender,fname,lname,email,password,phone,address,city, country,zip,state) VALUES('$salutation','$gender','$fname','$lname','$email','$password','$phone','$address','$city','$country','$zip','$state')";

            $customerinsert = $this->db->insert($query);
            if ($customerinsert) {
                $msg = "<span class='success'>Registration successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Registration not successfull.</span>";
                return $msg;
            }
	    }
	}

	public function customerLogin($data){
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

	public function getCustomerData($id){
		$query = "SELECT * FROM tbl_customer WHERE id='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCustomer(){
		$query = "SELECT * FROM tbl_customer LIMIT 6";
		$result = $this->db->select($query);
		return $result;
	}

	public function getCustCountry(){
		$query = "SELECT * FROM tbl_customer WHERE country='Bangladesh'";
		$result = $this->db->select($query);
		return $result;
	}

	public function customerUpdate($data,$cmrid){
		$fname 		= $this->fm->validation($data['fname']);
		$lname 		= $this->fm->validation($data['lname']);
		$address 	= $this->fm->validation($data['address']);
		$city 		= $this->fm->validation($data['city']);
		$country 	= $this->fm->validation($data['country']);
		$zip 		= $this->fm->validation($data['zip']);
		$phone 		= $this->fm->validation($data['phone']);
		$email 		= $this->fm->validation($data['email']);

		$fname 		= mysqli_real_escape_string($this->db->link, $data['fname']);
		$lname 		= mysqli_real_escape_string($this->db->link, $data['lname']);
		$address 	= mysqli_real_escape_string($this->db->link, $data['address']);
		$city 		= mysqli_real_escape_string($this->db->link, $data['city']);
		$country 	= mysqli_real_escape_string($this->db->link, $data['country']);
		$zip 		= mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
		$email 		= mysqli_real_escape_string($this->db->link, $data['email']);

		if ($fname == "" || $lname == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "") {
	    	$msg = "<span class='error'>Fields must not be empty.</span>";
            return $msg;
	    }else{
	    	$query = "UPDATE tbl_customer
	    				SET
	    				fname	=	'$fname',
	    				lname	=	'$lname',
	    				address =	'$address',
	    				city	=	'$city',
	    				country	=	'$country',
	    				zip		=	'$zip',
	    				phone	=	'$phone',
	    				email	=	'$email'
	    				WHERE id=	'$cmrid'";
        	$updated_row = $this->db->update($query);
        	if ($updated_row) {
        		$msg = "<span class='success'>Customer Data Updated successfully.</span>";
                return $msg;
        	}else{
        		$msg = "<span class='error'>Customer Data not Updated.</span>";
                return $msg;
        	}
	    }
	}
}


 ?>
