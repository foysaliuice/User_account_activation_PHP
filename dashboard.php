<?php $title = "Dashboard";?>
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
<div class="dropdown" style="float:right;">
  <button class="dropbtn"><?php echo Session::get('m_name');?></button>
  <div class="dropdown-content">
    <a href="#">Submit Paper</a>
    <a href="#">Change password</a>
    <a href="?cid=<?php Session::get('m_Id'); ?>">Logout</a>
  </div>
</div>
<div class="card">
  <p class="title">Welcome</p> 
  <div class="button-container">
    <a href="submit_paper.php" class="button"><span>Submit paper</span></a>
  </div>
</div>
<?php include('inc/footer.php');?>