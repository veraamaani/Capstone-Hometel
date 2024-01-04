<?php
include "zzz_initialize.php";

$id = $_POST['id'];

$sqlQuery = " SELECT * FROM account WHERE id=".$id;
$res = $link->query($sqlQuery);

while($row = mysqli_fetch_object($res))
{
?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Edit Account</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body" style="color: black;">

    <div class="container">
      <h4>Personal Information</h4>
      <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="nm" placeholder="Enter fullname" value="<?php echo $row->name; ?>" required>
        <input type="text" class="form-control" name="old_nm" placeholder="Enter fullname" value="<?php echo $row->name; ?>" hidden required>

      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="em" placeholder="Enter email" value="<?php echo $row->email; ?>" required>
      </div>
      <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control" name="ad" placeholder="Enter email" value="<?php echo $row->address; ?>" required>
      </div>
      <div class="form-group">
        <label>Contact Number</label>
        <input type="text" class="form-control" name="cn" placeholder="Enter contact number" value="<?php echo $row->contact_number; ?>" required>
      </div>
    </div>

    <hr style="border-color: black;"/>

    <div class="container">
      <h4>Account Information</h4>
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="un" placeholder="Enter username" value="<?php echo $row->username; ?>" required>
        <input type="text" class="form-control" name="old_un" placeholder="Enter username" value="<?php echo $row->username; ?>" hidden required>

      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="text" class="form-control" name="pw" placeholder="Enter password" value="<?php echo $row->password; ?>" required>
      </div>
      <div class="form-group">
        <label>Account Type</label>
        <select class="mb-3" name="t" >
          <?php 
            if($row->type == "Admin")
            {
              echo "<option value='Admin'>Admin</option>";
              echo "<option value='Staff'>Staff</option>";
            }
            else
            {
              echo "<option value='Staff'>Staff</option>";
              echo "<option value='Admin'>Admin</option>";
            }
          ?>
        </select>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Cancel</button>
    <button style="height:36px;border-radius:30px;" class="btn btn-info" type="submit" value="<?php echo $row->id?>" name="edit_btn">Edit</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->
<?php } ?>