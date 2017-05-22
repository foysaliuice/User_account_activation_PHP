<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	/**
	* Social
	*/
	class Social{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function updateSocial($data){
		$facebook 	= $this->fm->validation($data['facebook']);
		$twitter 	= $this->fm->validation($data['twitter']);
		$gplus 		= $this->fm->validation($data['gplus']);
		$pinterest 	= $this->fm->validation($data['pinterest']);
		$instagram 	= $this->fm->validation($data['instagram']);
		$linkedIn 	= $this->fm->validation($data['linkedIn']);
		$vimeo 		= $this->fm->validation($data['vimeo']);
		$youtube 	= $this->fm->validation($data['youtube']);
		$filckr 	= $this->fm->validation($data['filckr']);

		$facebook 	= mysqli_real_escape_string($this->db->link, $data['facebook']);
		$twitter 	= mysqli_real_escape_string($this->db->link, $data['twitter']);
		$gplus 	= mysqli_real_escape_string($this->db->link, $data['gplus']);
		$pinterest 	= mysqli_real_escape_string($this->db->link, $data['pinterest']);
		$instagram 	= mysqli_real_escape_string($this->db->link, $data['instagram']);
		$linkedIn 	= mysqli_real_escape_string($this->db->link, $data['linkedIn']);
		$vimeo 	= mysqli_real_escape_string($this->db->link, $data['vimeo']);
		$youtube 	= mysqli_real_escape_string($this->db->link, $data['youtube']);
		$filckr 	= mysqli_real_escape_string($this->db->link, $data['filckr']);

		$query = "UPDATE tbl_social
	    				SET
	    				facebook = '$facebook',
	    				twitter = '$twitter',
	    				gplus = '$gplus',
	    				pinterest = '$pinterest',
	    				instagram = '$instagram',
	    				linkedIn = '$linkedIn',
	    				vimeo = '$vimeo',
	    				youtube = '$youtube',
	    				filckr = '$filckr'";

            $socialUpdate = $this->db->insert($query);
            if ($socialUpdate) {
                $msg = "<span class='success'>Socila Link updated successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Socila Link not updated.</span>";
                return $msg;
            }
	}

	public function getAllLink(){
		$query = "SELECT * FROM tbl_social";
		$result = $this->db->select($query);
		return $result;
	}	
}
?>