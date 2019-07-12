<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';

  //to handle get request for user data deletion
  if (isset($_GET['action']) and $_GET['action']=='delete') {
    $id=$_GET['id'];
    if ($query=mysqli_query($mysqli,"DELETE FROM users WHERE id=$id")) {
      echo "1";
    }else {
      echo '0';
    }
  }

  //to handle get request for user data check
  if (isset($_GET['check'])) {
    $checkwhat=$_GET['check'];
    $checkwhatvalue=$_GET['value'];
    if ($query=mysqli_query($mysqli,"DELETE FROM users WHERE $checkwhat=$checkwhatvalue")) {
      echo "1";
    }else {
      echo '0';
    }
  }

  //to handle post request for user data update
    if (isset($_POST['submit']) and $_POST['submit']=='update'){
      $id=$_POST['id'];
      $username=$_POST['username'];
      $cno=$_POST['cno'];
      $email=$_POST['email'];
      $status=$_POST['status'];


      if ($query = mysqli_query($mysqli,"UPDATE users SET username='$username', cno='$cno', email='$email', status='$status' WHERE id=$id")) {
        echo '1';
      }else {
        echo '0';
      }
    }
?>
