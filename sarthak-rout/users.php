<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';
  include '../lib/functions.php';

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <meta charset="utf-8">
    <title>DATABASE</title>
    <?php include '../config/csscdn.php';?>

  </head>

  <body id="body">
    <table class="table table-responsive table-striped">
      <thead class="thead-dark">
        <th>ID</th>
        <th>USERNAME</th>
        <th>PASSWORD</th>
        <th>ACTION</th>
      </thead>
      <tbody id="users-list">
        <?php
          if ($query=mysqli_query($mysqli,"SELECT * FROM users")) {
            while ($row=mysqli_fetch_array($query)) {
                echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['username'].'</td>
                  <td>'.$row['password'].'</td>
                  <td align="center">
                  <i onclick="javascript: remove('.$row['id'].');" class="fa fa-times-circle" aria-hidden="true" style="color:red;cursor:pointer;"></i>&nbsp;&nbsp;
                  <i onclick="javascript: edit('.$row['id'].');" class="fa fa-pencil-square " aria-hidden="true" style="color:orange;cursor:pointer"></i></td>
                </tr>';
            }
          }
         ?>
      </tbody>
      <tfoot class="thead-dark">
        <th>ID</th>
        <th>USERNAME</th>
        <th>PASSWORD</th>
        <th>ACTION</th>
      </tfoot>
    </table>
    <button type="button" class="btn btn-info" name="button" onclick="javascript: if(confirm('Are you sure')) location.href='index.php'; " style="margin-left: 758px;">Go Back</button>
    <?php include '../config/jscdn.php'; ?>
    <script>
      function remove(id){
        if(confirm("Do you really want to remove the user - " + id))
          delete_id(id);
      }

      function delete_id(id) {
        $.ajax({
          url: 'action.php',
          type: 'GET',
          data: {
            action: 'delete',
            id: id
          },
          datatype: 'html',
          success: function(response){
            if (response == 1) {
              refresh_users();
              notify(id,'Deleted Successfully', 'success');

            }
          }
        });
      }

      function refresh_users() {
        $("#body").hide();
        $("#users-list").empty().delay(1500);
        $.ajax({
          url: "list.php",
          type: 'GET',
          data:{
            getlist: 'users'
          },
          datatype: 'html',
          success: function(response){
            $("#users-list").html(response);
            $("#body").slideDown(3000);
          }
        });
      }

    function edit (id){
        $("#editModalbody").empty();
        $.ajax({
          url: "modal.php",
          type: 'GET',
          data:{
            id: id,
            action: 'edit'
          },
          datatype: 'html',
          success: function(response){
            $("#editModalbody").html(response);
          }
        });

        $("#editModal").modal("show");
      };
    </script>

  </body>

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="editModalbody">

      </div>
    </div>
  </div>
</html>
