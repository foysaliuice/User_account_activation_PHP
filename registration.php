<?php include('inc/header.php');?>
<?php
  $member_regi = new MemberRegi();

  if ($_SERVER['REQUEST_METHOD']=='POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $insert_member = $member_regi->MemberRegistration($name, $email);
  }
?>

      <h1 class="title">Member Registration</h1>
      <form action="registration.php" method="POST">
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
        <?php
          if (isset($insert_member)) {
            echo $insert_member;
          }
        ?>
          <button><span>Register</span></button>
        </div>
        
        <div class="footer"><a href="login.php">Already register? Login</a></div>
      </form>
    </div>
  </div>
<?php include('inc/footer.php');?>