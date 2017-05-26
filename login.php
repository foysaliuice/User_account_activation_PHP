<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Member Login</title>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <div class="card"></div>
    <div class="card">
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
          <button><span>Login</span></button>
        </div>
        <div class="footer"><a href="#">Forgot your password?</a></div>
      </form>
    </div>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
</body>
</html>
