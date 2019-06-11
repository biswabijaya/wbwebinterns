<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';

  if (isset($_GET['action']) and $_GET['action']=='delete') {
    $id=$_GET['id'];
    if ($query=mysqli_query($mysqli,"DELETE FROM users WHERE id=$id")) {
      echo "1";
    }
  }

  //to handle post request for user data update
    if (isset($_POST['submit']) and $_POST['submit']=='update'){
      $username=$_POST['username'];
      $cno=$_POST['cno'];
      $email=$_POST['email'];
      $status=$_POST['status'];

      if ($query = mysqli_query($mysqli,"UPDATE users SET username='$username', cno=$cno, email='$email', status=$status")) {
        echo '<script>
          notify("'.$username.'","Updated Successfully","success");
        </script>';
      }else {
        echo '<script>
          notify("'.$username.'","Update Failed","danger");
        </script>';
      }

    }

?>
