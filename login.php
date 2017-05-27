<?php include('inc/header.php');?>
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
        $M_Login = $member_login->memberLogin($_POST);
    }
 ?>
 <?php
 $login = Session::get("memberLogin");
 if ($login==true) {
  echo "<script>location.replace('dashboard.php');</script>";
 }
?>
  
      <h1 class="title">Member Login</h1>
      <form action="" method="POST">
        <div class="input-container">
          <input type="email" name="email" required="required"/>
          <label>Email ID</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" name="password" required="required"/>
          <label>Password</label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
        <?php
                if (isset($M_Login)) {
                  echo $M_Login;
                }
               ?>
          <button name="login"><span>Login</span></button>
        </div>
        <div class="footer"><a href="#">Forgot your password?</a></div>
      </form>
    </div>
<?php include('inc/footer.php');?>
