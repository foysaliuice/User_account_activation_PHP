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
  <p class="title">Submit</p> 
  <form>
    <div class="input-container">
    <input type="file" name="att" required="required"/>
    <div class="button-container">
    <button name="login"><span>Submit</span></button>
  </div>
  </div>
  </form>
</div>
<?php include('inc/footer.php');?>