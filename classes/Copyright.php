<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	/**
	* CopyRight
	*/
	class Copyright{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function updateCopyRightText($data){
		$copyrightText 	= $this->fm->validation($data['copyright']);
		$year 	= $this->fm->validation($data['year']);

		$copyrightText   = mysqli_real_escape_string($this->db->link, $data['copyright']);
		$year   = mysqli_real_escape_string($this->db->link, $data['year']);
		if ($copyrightText=="" || $year=="") {
			$msg = "<span class='error'>Fields must not be empty.</span>";
			return $msg;
		}else{
		$query = "UPDATE tbl_copyright
	    				SET
	    				copyright = '$copyrightText',
	    				year = '$year'
	    				";

            $copyrightUpdate = $this->db->insert($query);
            if ($copyrightUpdate) {
                $msg = "<span class='success'>Copyright Text updated successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Copyright Text not updated.</span>";
                return $msg;
            }
        }
	}
	public function getCopyText(){
		$query  = "SELECT * FROM tbl_copyright";
		$result= $this->db->select($query);
		return $result;
	}
}
?>