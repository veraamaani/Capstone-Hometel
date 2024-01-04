<?php
include "zzz_initialize.php";

$id = $_POST['id'];

$sqlQuery = " SELECT * FROM reservation WHERE id=".$id;
$res = $link->query($sqlQuery);

while($row = mysqli_fetch_object($res))
{
?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Reservation Details</h4>
  </div>

  <div class="modal-body" style="color: black;">
    <div class="container" style="margin: 0 0 2.5% 0;">
      Name: <?php echo $row->guest_name; ?><br/>
      Contact Number: <?php echo $row->contact_number; ?><br/>
      Email: <?php echo $row->email; ?><br/>
      Address: <?php echo $row->address; ?><br/>
    </div>

    <div class="container" style="margin: 0 0 2.5% 0;">
      Number of guests: <?php echo $row->no_of_guest; ?><br/>
      Room(s): <?php echo $row->room; ?><br/>
    </div>

    <div class="container">
      Arrival Date (Year-Month-Date): <?php echo $row->arrival_date; ?><br/>
      Departure Date (Year-Month-Date): <?php echo $row->departure_date; ?><br/>
      Length of stay: <?php echo $row->length_of_stay; ?><br/>
      Cost: ₱<?php echo $row->cost; ?><br/>
      Amount Paid: ₱<?php echo $row->payment_received; ?><br/>
      Change: ₱<?php echo $row->payment_change; ?><br/><br/>
    </div>

    <hr style="border-color: black;"/>
    Reservation Status: <span style="color:blue;">Confirmed</span><br/>
    Remark: <?php echo $row->remark; ?><br/>
  </div>
  <div class="modal-footer">
    <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
  </div>
  <!-- MODAL CONTENT [END]-->
<?php } ?>