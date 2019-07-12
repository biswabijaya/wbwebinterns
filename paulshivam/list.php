<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';

  if (isset($_GET['getlist']) and $_GET['getlist']=='users') {
    if ($query=mysqli_query($mysqli,"SELECT * FROM users")) {
      while ($row=mysqli_fetch_array($query)) {
        if($row['status']==1) {
          $tdcolor="table-success";
        } else if ($row['status']==0) {
          $tdcolor="table-warning";
        } else if ($row['status']==2) {
          $tdcolor="table-secondary";
        } else {
          $tdcolor="table-secondary";
        }
          echo '<tr class="'.$tdcolor.'">
            <td>'.$row['id'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['cno'].'</td>
            <td>'.$row['status'].'</td>
            <td align="center">
            <i onclick="javascript: remove('.$row['id'].');" class="fa fa-times-circle" aria-hidden="true" style="color:red"></i>&nbsp;&nbsp;
            <i onclick="javascript: edit('.$row['id'].');" class="fa fa-pencil-square" aria-hidden="true" style="color:orange"></i></td>
          </tr>';
      }
    }
  }
?>
