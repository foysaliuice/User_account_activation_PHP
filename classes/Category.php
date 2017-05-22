<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
/**
* Category Class
*/
class Category{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function catInsert($catName,$catGroup){
		$catName = $this->fm->validation($catName);
		$catGroup = $this->fm->validation($catGroup);

		$catName = mysqli_real_escape_string($this->db->link, $catName);
		$catGroup = mysqli_real_escape_string($this->db->link, $catGroup);

		if (empty($catName) || empty($catGroup)) {
			$loginMsg = "Field must not be empty";
			return $loginMsg;
		}

		$catChkQuery = "SELECT * FROM tbl_category WHERE catName = '$catName'";
		$chkcat = $this->db->select($catChkQuery);

		if ($chkcat !=false) {
			$msg = "<span class='error'>Category Name already exists.</span>";
			return $msg;
		}else{
			$query 	= "INSERT INTO tbl_category(catName,catGroup,date) VALUES('$catName','$catGroup',Now())";
			$result = $this->db->insert($query);

			if ($result) {
				$msg = "<span class='success'>Category Inserted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Category Not Inserted Successfully.</span>";
				return $msg;
			}
		}
	}

	public function getAllCat(){
		$query 	= "SELECT * FROM tbl_category ORDER BY catName ASC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getAllAdminCat(){
		$query 	= "SELECT * FROM tbl_category ORDER BY catName ASC LIMIT 6";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getAllCatByCatGroup1(){
		$query 	= "SELECT * FROM tbl_category WHERE catGroup='1' ORDER BY catId DESC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getAllCatByCatGroup2(){
		$query 	= "SELECT * FROM tbl_category WHERE catGroup='2' ORDER BY catId DESC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getAllCatByCatGroup3(){
		$query 	= "SELECT * FROM tbl_category WHERE catGroup='3' ORDER BY catId DESC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getAllCatByCatGroup4(){
		$query 	= "SELECT * FROM tbl_category WHERE catGroup='4' ORDER BY catId DESC";
		$result	= $this->db->select($query);
		return $result;
	}

	public function getCatById($id){
		$query 	= "SELECT * FROM tbl_category WHERE catId='$id'";
		$result	= $this->db->select($query);
		return $result;
	}

	public function catUpdate($catName,$id){
		$id 		= $this->fm->validation($id);
		$catName 	= $this->fm->validation($catName);

		$id 		= mysqli_real_escape_string($this->db->link, $id);
		$catName 		= mysqli_real_escape_string($this->db->link, $catName);

		if (empty($catName)) {
			$loginMsg = "Field must not be empty";
			return $loginMsg;
		}else{
			$query = "UPDATE tbl_category
						SET
						catName 	= '$catName'
						WHERE catId	= '$id'";
			$result =$this->db->update($query);
			if ($result) {
				$msg = "<span class='success'>Category Updated Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Category Not Updated Successfully.</span>";
				return $msg;
			}
		}
	}

	public function delCatById($id){
		$query = "DELETE FROM tbl_category WHERE catId='$id'";
		$result = $this->db->delete($query);
		if ($result) {
				$msg = "<span class='success'>Category Deleted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Category Not Deleted Successfully.</span>";
				return $msg;
			}
	}
}

?>