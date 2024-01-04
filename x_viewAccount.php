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
    <h4 class="modal-title" style="color: white;">View Account</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body" style="color: black;">

    <div class="container">
      <h4>Personal Information</h4>
      <div class="form-group">
        Name: <?php echo $row->name; ?>
      </div>
      <div class="form-group">
        Email: <?php echo $row->email; ?>
      </div>
      <div class="form-group">
        Address: <?php echo $row->address; ?>
      </div>
    </div>

    <hr style="border-color: black;"/>

    <div class="container">
      <h4>Account Information</h4>
      <div class="form-group">
        Username: <?php echo $row->username; ?>
      </div>
      <div class="form-group">
        Password: <?php echo $row->password; ?>
      </div>
      <div class="form-group">
        Account Type: <?php echo $row->type; ?>
      </div>
      <div class="form-group">
        Contact Number: <?php echo $row->contact_number; ?>
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Close</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->
<?php } ?>