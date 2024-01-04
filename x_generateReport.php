<?php
include "zzz_initialize.php";

// Variables used to get total number of reservation per room
$r1_r = 0; 
$r2_r = 0;
$r3_r = 0;
// Variables used to get total length of stay per room (Used to calculate total income per room)
$r1_los = 0; 
$r2_los = 0;
$r3_los = 0;

// Get total number of reservation for Room 1
$sqlQuery = " SELECT room, length_of_stay FROM reservation 
              WHERE (arrival_date >= '$_POST[start_date]' AND departure_date <= '$_POST[end_date]') 
              AND room LIKE '%1%' AND status ='Confirmed' 
";
$res = $link->query($sqlQuery);
while($row = mysqli_fetch_object($res)){ ++$r1_r; $r1_los += $row->length_of_stay; }

// Get total number of reservation for Room 2
$sqlQuery = " SELECT room, length_of_stay FROM reservation 
              WHERE (arrival_date >= '$_POST[start_date]' AND departure_date <= '$_POST[end_date]')
              AND room LIKE '%2%' AND status ='Confirmed'
";
$res = $link->query($sqlQuery);
while($row = mysqli_fetch_object($res)){ ++$r2_r; $r2_los += $row->length_of_stay; }

// Get total number of reservation for Room 3
$sqlQuery = " SELECT room, length_of_stay FROM reservation 
              WHERE (arrival_date >= '$_POST[start_date]' AND departure_date <= '$_POST[end_date]')
              AND room LIKE '%3%' AND status ='Confirmed'
";
$res = $link->query($sqlQuery);
while($row = mysqli_fetch_object($res)){ ++$r3_r; $r3_los += $row->length_of_stay; }

// Calculate total income for each room
$r1_i = $r1_los * 1600;
$r2_i = $r2_los * 1200;
$r3_i = $r3_los * 1000;

?>
  <!-- MODAL CONTENT [START]-->
  <div class="modal-header" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Reservation Details</h4>
    <div>
    <button style="height:36px;border-radius:30px;"type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    <button style="height:36px;border-radius:30px;"type="button" class="savePDF btn btn-success">Save</button>
    </div>
  </div>

  <!-- REPORT CONTENT -->
  <div class="modal-body" style="color: black;"><!-- MODAL BODY div (START) -->
    
    <div id="REPORT_BODY"><!-- REPORT CONTENT div (START) -->
    <p>
    <b>CRMC HOMETEL</b><br/>
    <b><?php echo($_POST["month"]." ".$_POST["year"]);?> Reservation Report</b><br/>
    </p>

    <p>
    Room Rates
    <ul>
    <li>Room 1 = Php 1,600</li>
    <li>Room 2 = Php 1,200</li>
    <li>Room 3 = Php 1,000</li>
    </ul>
    </p>

    <p>
    Number of reservation per room
    <ul>
    <li>Room 1 = <?php echo($r1_r); ?> </li>
    <li>Room 2 = <?php echo($r2_r); ?> </li>
    <li>Room 3 = <?php echo($r3_r); ?> </li>
    </ul>
    </p>

    <p>
    Income per room
    <ul>
    <li>Room 1 = Php <?php echo number_format($r1_i); ?> </li>
    <li>Room 2 = Php <?php echo number_format($r2_i); ?> </li>
    <li>Room 3 = Php <?php echo number_format($r3_i); ?> </li>
    </ul>
    </p>

    <p>
    <b>Total income (Note: It doesn't include computation for 'remarks' such as 'extra bed'):</b> Php <?php echo number_format($r1_i+$r2_i+$r3_i); ?>
    </p>
    </div><!-- REPORT CONTENT div (END) -->

    <!-- Table -->
    <div><!-- TABLE div (Start) -->
      <table id="REPORT_TABLE" class="table table-striped table-bordered text-center noselect">
        <thead class="table-dark">
          <tr>
            <td colspan="5">Reservation List</td> 
          </tr>
          <tr>
            <th>Date of Confirmation</th>
            <th>Guest Name</th>
            <th>Room(s) reserved</th>
            <th>Length of stay</th>
            <th>Reservation Cost</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sqlQuery = " SELECT * FROM reservation WHERE status ='Confirmed' AND (arrival_date >= '$_POST[start_date]' AND departure_date <= '$_POST[end_date]') ";
            $res = $link->query($sqlQuery);
            while($row = mysqli_fetch_object($res)){
          ?>
          <tr>
            <td> <?php echo $row->arrival_date; ?> </td>
            <td> <?php echo $row->guest_name; ?> </td>
            <td> <?php echo $row->room; ?> </td>
            <td> <?php echo $row->length_of_stay; ?> </td>
            <td> Php <?php echo $row->cost; ?> </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div><!-- TABLE div (END) -->
  </div><!-- MODAL BODY div (END) -->
  <!-- MODAL CONTENT [END]-->

<!------------------ SCRIPT -------------------->

<script type='text/javascript'>

  // CONFIRM RESERVATION Modal
  $(document).ready(function(){
    $('.savePDF').click(function(){
      const hometel_report = new jsPDF('p', 'pt', 'a4');
      var specialElementHandlers = { '#REPORT_BODY': function (element, renderer) { return true; }};
      hometel_report.fromHTML($('#REPORT_BODY').html(), 10, 10, { 'width': 500, 'elementHandlers': specialElementHandlers });
      

      hometel_report.autoTable({ html:'#REPORT_TABLE', startY: 370, theme:'striped' });
      
      
      hometel_report.save('CRMC Hometel Reservation Report.pdf');
    });
  });

</script>