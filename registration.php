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
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Portal</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
          <div class="panel-heading">Member Registration</div>
          <div class="panel-body">
            <form action="" method="POST">
            <?php
              if (isset($insert_member)) {
                echo $insert_member;
              }
            ?>
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
              </div>
              <button type="submit" name="submit" class="btn btn-info">Registration</button>
            </form>
            
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>