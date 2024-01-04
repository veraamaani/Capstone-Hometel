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
    <h4 class="modal-title" style="color: white;">Confirm Reservation</h4>
  </div>

  <form autocomplete="off" method="post">
  <div class="modal-body noselect" style="color: black;">

    <h3>Enter the amount of money paid by the guest then press the confirm button (Currency is in Philippine Peso)</h3>
    <input type="number" name="c" value="<?php echo $row->cost; ?>" hidden required>
    <div class="form-group">
    <input type="number" class="form-control" name="p" placeholder="Enter amount paid the guest" required>
    </div>

  </div>
  <div class="modal-footer noselect">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Cancel</button>
    <button style="height:36px;border-radius:30px;" class="btn btn-info" type="submit" value="<?php echo $row->id?>" name="confirm_btn">Confirm</button>
  </div>
  </form>
  <!-- MODAL CONTENT [END]-->
<?php } ?>