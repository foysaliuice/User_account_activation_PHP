<?php include('inc/header.php');?>
<?php
	$member_regi = new MemberRegi();
	$email = $_GET['email'];
	$code = $_GET['code'];
	
	$Update = $member_regi->EmailActivation($email, $code);

?>
      <h1 class="title">Activated</h1>
      <div class="button-container">
      <?php
      	if (isset($Update)) {
      		echo $Update;
      	}
      ?>
        <a href="login.php" class="button"><span>Login</span></a>
      </div>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
</body>
</html>
