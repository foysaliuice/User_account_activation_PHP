<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	/**
	* Slider
	*/
	class Slider{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insertSlider($file){
		$permited  		= array('jpg', 'jpeg', 'png', 'gif');
	    $file_name 		= $file['image']['name'];
	    $file_size 		= $file['image']['size'];
	    $file_temp 		= $file['image']['tmp_name'];

	    $div 			= explode('.', $file_name);
	    $file_ext 		= strtolower(end($div));
	    $unique_image	= substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "uploads/slider/".$unique_image;

	    if ($uploaded_image=="") {
	    	$msg = "<span class='error'>Fields must not be empty.</span>";
                return $msg;
	    }elseif ($file_size >1048567) {
	     echo "<span class='error'>Image Size should be less then 1MB!
	     </span>";
	    } elseif (in_array($file_ext, $permited) === false) {
	     echo "<span class='error'>You can upload only:-"
	     .implode(', ', $permited)."</span>";
	    }else{
	    	move_uploaded_file($file_temp, $uploaded_image);
	    	$query = "INSERT INTO tbl_slider(image) VALUES('$uploaded_image')";

            $sliderinsert = $this->db->insert($query);
            if ($sliderinsert) {
                $msg = "<span class='success'>Slider inserted successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Slider not inserted.</span>";
                return $msg;
            }
	    }
	}

	public function getAllSlider(){
		$query = "SELECT * FROM tbl_slider ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function delSliderById($id){
		$query = "SELECT * FROM tbl_slider WHERE id = '$id'";
		$getData = $this->db->select($query);
		if ($getData) {
			while ($delImg = $getData->fetch_assoc()) {
				$dellink = $delImg['image'];
				unlink($dellink);
			}
		}
		$delquery = "DELETE FROM tbl_slider WHERE id = '$id'";
		$deldata = $this->db->delete($delquery);
		if ($deldata) {
			$msg = "<span class='success'>Slider Deleted successfully.</span>";
                return $msg;
		}else{
        		$msg = "<span class='error'>Slider not Deleted.</span>";
                return $msg;
        	}
	}
}
?>