<?php
//packages to include
  include '../config/db.php';
  include '../config/session.php';
  include '../lib/functions.php';

//check session
if (isset($_SESSION['id'])) {
  header("Location: index.php?msg=User%20already%20logged%20in");
}

//global data member
  $msg = 0;

//to handle post request for user register
  if (isset($_POST['submit']) and $_POST['submit']=='register'){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password=password_hash($password,PASSWORD_DEFAULT);

    $found=0;
    if ($query = mysqli_query($mysqli,"SELECT * from users WHERE username = '$username'")) {
      while ($row=mysqli_fetch_array($query)) {
        $found = 1;
        $msg = 'User already exists';
      }
    }
    if (!$found) {
      if($query=mysqli_query($mysqli,"INSERT INTO users (username,password) VALUES('$username','$password')")){
        header("Location: index.php?msg=successful");
      } else {
        header("Location: register.php?msg=notsuccessful");
      }
    }


  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>qwerty</title>
    <?php include '../config/csscdn.php';?>

  </head>
  <style>
    .login{
      width: 300px;
      height: 400px;
      padding-top: 20px;
      padding-left: 20px;
      margin:auto;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-top: 100px;
      background-image: linear-gradient(to top, rgb(48, 207, 208) 0%, rgb(51, 8, 103) 100%);
    }

    #logo{
      width:100px;
      height:100px;
      margin:0px 70px 10px 70px;
    }

    input[type=text], input[type=password]{
      width: 90%;
    }
    body{
      background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);
    }

  </style>
  <body>
    <div class="login">
      <form method="post">
        <img src="https://image.flaticon.com/icons/png/512/306/306473.png" id="logo"><br><br>
        <b>USERNAME:</b> <input type="text" name="username" placeholder="Enter username"><br><br>
        <b>PASSWORD:</b> <input type="password" name="password" placeholder="Enter password"><br><br>
        <button type="button" class="btn btn-light "name="button" onclick="javascript: if(confirm('Are you sure')) location.href='index.php'; ">Return</button>
        <button type="submit" class="btn btn-success " name="submit" value="register" style="margin-left:80px;">Register</button>

      </form>
    </div>
    <?php include '../config/jscdn.php'; ?>
  </body>
  <script type="text/javascript">
    <?php
    if ($msg) {
      echo 'alert("'.$msg.'")';
    }
     ?>
  </script>
</html>
