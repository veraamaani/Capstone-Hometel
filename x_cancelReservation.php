<?php
include "zzz_initialize.php";

$id = $_POST['id'];

$sqlQuery = " SELECT * FROM reservation WHERE id=".$id;
$res = $link->query($sqlQuery);

while($row = mysqli_fetch_object($res))
{
?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header noselect" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Cancel Reservation</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body noselect" style="color: black;">

    <h1>Are you sure you want to cancel the selected reservation?</h1>

  </div>
  <div class="modal-footer noselect">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>No</button>
    <button style="height:36px;border-radius:30px;" class="btn btn-danger" type="submit" value="<?php echo $row->id?>" name="cancel_btn">Yes</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->
<?php } ?>