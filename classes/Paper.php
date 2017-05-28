<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
class Paper{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function SavePaper($file){
		$permited  		= array('jpg', 'jpeg', 'png', 'gif','pdf','doc','docx','ppt','pptx');
	    $file_name 		= $file['att']['name'];
	    $file_size 		= $file['att']['size'];
	    $file_temp 		= $file['att']['tmp_name'];

	    $div 			= explode('.', $file_name);
	    $file_ext 		= strtolower(end($div));
	    $unique_image	= substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "Upload/".$unique_image;

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
	    	$name = session::get("m_name");
	    	$email = session::get("m_email");
	    	
	    	
	    	$query = "INSERT INTO tbl_paper(m_name,m_email,image) VALUES('$name','$email','$uploaded_image')";

            $sliderinsert = $this->db->insert($query);
            if ($sliderinsert) {
                $msg = "<span class='success'>Paper inserted successfully.</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Paper not inserted.</span>";
                return $msg;
            }
	    }
	}
}
?>