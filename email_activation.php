<?php include 'classes/MemberRegi.php'; ?>
<?php
	$member_regi = new MemberRegi();
	$email = $_GET['email'];
	$code = $_GET['code'];
	
	$Update = $member_regi->EmailActivation($email, $code);

?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Member Portal</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="card"></div>
    <div class="card">
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
