<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
/**
* Brand Class
*/
class Brand{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);

		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			$loginMsg = "Field must not be empty";
			return $loginMsg;
		}
		
		$brandChkQuery = "SELECT * FROM tbl_brand WHERE brandName = '$brandName'";
		$chkBrand = $this->db->select($brandChkQuery);

		if ($chkBrand !=false) {
			$msg = "<span class='error'>Brand Name already exists.</span>";
			return $msg;
		}else{
			$query 	= "INSERT INTO tbl_brand(brandName,date) VALUES('$brandName',Now())";
			$result = $this->db->insert($query);

			if ($result) {
				$msg = "<span class='success'>Brand Inserted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Brand Not Inserted Successfully.</span>";
				return $msg;
			}
		}
	}

	public function getAllBrand(){
		$query 	= "SELECT * FROM tbl_brand ORDER BY brandName ASC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getBrandById($id){
		$query 	= "SELECT * FROM tbl_brand WHERE BrandId='$id'";
		$result	= $this->db->select($query);
		return $result;
	}

	public function brandUpdate($brandName,$id){
		$id 		= $this->fm->validation($id);
		$brandName 	= $this->fm->validation($brandName);

		$id 		= mysqli_real_escape_string($this->db->link, $id);
		$brandName 		= mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			$loginMsg = "Field must not be empty";
			return $loginMsg;
		}else{
			$query = "UPDATE tbl_brand
						SET
						brandName 	= '$brandName'
						WHERE brandId	= '$id'";
			$result =$this->db->update($query);
			if ($result) {
				$msg = "<span class='success'>Brand Updated Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Brand Not Updated Successfully.</span>";
				return $msg;
			}
		}
	}

	public function delBrandById($id){
		$query = "DELETE FROM tbl_brand WHERE brandId='$id'";
		$result = $this->db->delete($query);
		if ($result) {
				$msg = "<span class='success'>Brand Deleted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Brand Not Deleted Successfully.</span>";
				return $msg;
			}
	}
}

?>