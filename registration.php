<?php include 'classes/MemberRegi.php'; ?>

<?php
  $member_regi = new MemberRegi();

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $insert_member = $member_regi->MemberRegistration($name, $email);
  }
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Member Registration</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="card"></div>
    <div class="card">
      <h1 class="title">Member Registration</h1>
      <form action="" method="POST">
        <div class="input-container">
          <input type="text" name="name" required="required"/>
          <label>Member name</label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="email" name="email" required="required"/>
          <label>Email ID</label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span>Register</span></button>
        </div>
        <div class="footer"><a href="login.php">Already register? Login</a></div>
      </form>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
</body>
</html>