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

  <body>
    <div class="row">
      <div class="col-md-1">

      </div>
      <div class="col-md-10">
        <div id="body">
          <table class="table table-hover table-borderless" style="text-align: center;">
            <thead class="thead-dark">
              <th>ID</th>
              <th>USERNAME</th>
              <th>EMAIL</th>
              <th>CONTACT </th>
              <th>STATUS</th>
              <th>ACTION</th>
            </thead>
            <tbody id="users-list">
              <?php
              if ($query=mysqli_query($mysqli,"SELECT * FROM users")) {
                while ($row=mysqli_fetch_array($query)) {
                  if ($row['status']==1) {
                    $tdcolor="table-success";
                  }else if($row['status']==0){
                    $tdcolor="table-warning";
                  }else if($row['status']==2){
                    $tdcolor="table-secondary";
                  }else {
                    $tdcolor="table-info";
                  }
                  echo '<tr class="'.$tdcolor.'">
                    <td>'.$row['id'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['cno'].'</td>
                    <td>'.$row['status'].'</td>
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
              <th>EMAIL</th>
              <th>CONTACT </th>
              <th>STATUS</th>
              <th>ACTION</th>
            </tfoot>
          </table>
          <button type="button" class="btn btn-warning pull-left" name="button" onclick="javascript: if(confirm('Are you sure')) location.href='index.php'; ">Go Back</button>
          <button type="button" class="btn btn-info pull-right" name="button"  onclick="refresh_users();">Refresh</button>
        </div>
      </div>
    </div>



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
        $("#body").slideUp("slow");
        $("#users-list").delay(3000).empty();
        $.ajax({
          url: "list.php",
          type: 'GET',
          data:{
            getlist: 'users'
          },
          datatype: 'html',
          success: function(response){
            $("#users-list").html(response);
            $("#body").slideDown("slow");
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

    <script>
      function submitUpdateForm() {
        var uid=$("#uid").val();
        var username=$("#username").val();
        var cno=$("#cno").val();
        var email=$("#email").val();
        var status=$("#status").val();


        $.ajax({
          url:"action.php",
          type: "POST",
          data:{
            id:uid,
            username:username,
            cno:cno,
            email:email,
            status:status,
            submit:'update'
          },
          success: function(response){
            if (response==1) {
              $("#editModal").modal("hide");
              alert("Update Succesful");
              refresh_users();
            } else {
              alert("Update Unsuccessful");
            }
          }
        });


      }
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
