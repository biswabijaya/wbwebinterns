<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';
  include '../lib/functions.php';

  //check session
  if (isset($_SESSION['id'])) {
    header("Location: index.php?msg=User%20already%20logged%20in");
  }

  //global variable
  $iderror=$passerror=0;

  //to handle post request for user login
  if (isset($_POST['submit']) and $_POST['submit']=='login'){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $found=0;$iderror='Invalid Id';
    if($query=mysqli_query($mysqli,"SELECT * FROM users WHERE username='$username'"))
      while($row=mysqli_fetch_array($query)){
        //code to do any job on succesful login
        if (password_verify($password,$row['password'])) {
          $_SESSION['id']=$row['id'];
          $_SESSION['username']=$row['username'];
          header("Location: index.php?msg=Login%20Successful");
        } else {
          //code to do any job on unsuccesful login
          $passerror='Invalid Password';
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
      border: 2px solid blue;
      width: 300px;
      height: 400px;
      padding-top: 20px;
      padding-left: 20px;
      margin: auto;
      border: 1px solid #ccc;
      box-sizing: border-box;
      margin-top: 100px;
      background-image: linear-gradient(-225deg, #FFE29F 0%, #FFA99F 48%, #FF719A 100%);

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
        <img src="https://d1p9wirkq0k00v.cloudfront.net/wp-content/uploads/2019/05/02084053/hr.png" id="logo"><br><br>
        <b>USERNAME:</b> <input type="text" name="username"  <?php  if ($iderror) echo 'placeholder="'.$iderror.'"  autofocus'; else if(isset($_POST['username'])) echo 'value="'.$_POST['username'].'"'; else echo 'placeholder="Enter username" autofocus'; ?> required><br><br>
        <b>PASSWORD:</b> <input type="password" name="password"  <?php if($passerror) echo 'placeholder="'.$passerror.'" autofocus'; else echo 'placeholder="Enter password"' ;  ?> required><br><br>
        <button type="button" class="btn btn-light "name="button" onclick="javascript: if(confirm('Are you sure')) location.href='index.php'; ">Return</button>
        <button type="submit" class="btn btn-danger" name="submit" value="login" style="margin-left:100px;">Log In</button>


      </form>
    </div>
    <?php include '../config/jscdn.php'; ?>

  </body>
</html>
