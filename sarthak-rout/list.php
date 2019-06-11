<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';

  if (isset($_GET['getlist']) and $_GET['getlist']=='users') {
    if ($query=mysqli_query($mysqli,"SELECT * FROM users")) {
      while ($row=mysqli_fetch_array($query)) {
          echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['password'].'</td>
            <td align="center"><i onclick="remove('.$row['id'].')" class="fa fa-times-circle" aria-hidden="true" style="color:red"></i>&nbsp;&nbsp;<i class="fa fa-pencil-square" aria-hidden="true" style="color:orange"></i></td>
          </tr>';
      }
    }
  }
?>
