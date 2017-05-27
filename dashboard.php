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
<a class="logout" href="?cid=<?php Session::get('m_Id'); ?>">Logout</a>
  <p class="title">Welcome <?php echo Session::get('m_name');?></p> 
  <div class="button-container">
    <a href="submit_paper.php" class="button"><span>Submit paper</span></a>
  </div>
</div>
<?php include('inc/footer.php');?>