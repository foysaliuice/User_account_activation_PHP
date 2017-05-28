<?php include("inc/header.php"); ?>
<?php
 $login = Session::get("memberLogin");
   if ($login==false) {
    echo "<script>location.replace('login.php');</script>";
   }
?>
<?php
  if (isset($_GET['cid'])) {
    Session::destroy();
  }
?>
<?php
  $submit_paper = new Paper(); 
  if ($_SERVER['REQUEST_METHOD']=='POST') {
        $save_paper = $submit_paper->SavePaper($_FILES);
    }
?>
<a class="logout" href="?cid=<?php Session::get('m_Id'); ?>"><?php echo Session::get('m_name');?> (Logout)</a>
  <p class="title">Submit</p> 
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="input-container">
    <input type="file" name="att" required="required"/>
    <div class="button-container">
    <?php
      if (isset($save_paper)) {
        echo $save_paper;
      }
    ?>
    <button name="submit"><span>Submit</span></button>
  </div>
  </div>
  </form>
</div>
<?php include('inc/footer.php');?>