<?php

  //packages to include
  include '../config/db.php';
  include '../config/session.php';

  if (isset($_GET['action']) and $_GET['action']=='edit') {
    $id=$_GET['id'];
    if ($query=mysqli_query($mysqli,"SELECT * FROM users where id=$id")) {
      while ($row=mysqli_fetch_array($query)) {
          echo '<div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit '.$id.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="form" onsubmit="return false;">
            <div class="row">
              <div class="col">
                <label> Username </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">@</div>
                  </div>
                  <input type="text" class="form-control" id="username" value="'.$row['username'].'">
                </div>
              </div>
              <div class="col">
                <label>Contact No.</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">+91</div>
                  </div>
                  <input type="text" maxlength="10" class="form-control" id="cno" value="'.$row['cno'].'">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label>Email ID</label>
                <input type="email" class="form-control" value="'.$row['email'].'">

              </div>
              <div class="col">
                <label>Status</label>
                <select class="form-control" name="status" >';
                if ($row['status']==1) {
                  $print="selected";
                }else {
                  $print="";
                }
                echo '<option value="1" '.$print.'>Active</option>';
                if ($row['status']==0) {
                  $print="selected";
                }else {
                  $print="";
                }
                echo' <option value="0" '.$print.'>Inactive</option>';
                if ($row['status']==2) {
                  $print="selected";
                }else {
                  $print="";
                }
                echo '<option value="2" '.$print.'>Disabled</option>';
                echo '
                </select>
              </div>
            </div>
          </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" name="submit" value="update" class="btn btn-primary">Save changes</button>
          </div>';
      }
    }
}

?>


<script>
// Restrict input to digits and '.' by using a regular expression filter.
setInputFilter(document.getElementById("cno"), function(value) {
return /^\d*\.?\d*$/.test(value);
});
</script>
