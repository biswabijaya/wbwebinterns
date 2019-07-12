<?php
  include '../config/db.php';
  include '../config/session.php';
  include '../lib/functions.php';

  if (isset($_GET['msg'])) {
    $msg=$_GET['msg'];
  } else {
    $msg='';
  }


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome to WB WEB Code Lab</title>
    <?php include '../config/csscdn.php';?>
  </head>
  <body>
    <h1><?php echo $msg; ?></h1>
    <?php if (isset($_SESSION['id'])){ ?>
      <br>
      <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
      <button type="button" name="button" onclick="location.href='logout.php'">Logout</button>
    <?php } else { ?>
    <button type="button" name="button" onclick="location.href='register.php'">Register</button>
    <button type="button" name="button" onclick="location.href='login.php'">Login</button>
    <button type="button" name="button" onclick="location.href='users.php'">Display Table</button>

    <?php } ?>
    <?php include '../config/jscdn.php'; ?>
  </body>
</html>
