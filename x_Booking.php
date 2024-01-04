<?php
include "zzz_initialize.php";

// Calculate length of stay ($los)
$ad_value = strtotime($_POST["arrival_date"]);
$dd_value = strtotime($_POST["departure_date"]);
$los =  $dd_value - $ad_value;
$los = floor($los/(60*60*24));

// Variables used for checking room availability
$r1_check = 0;
$r2_check = 0;
$r3_check = 0;
$new_arrival_date = $_POST["arrival_date"];
$new_departure_date = $_POST["departure_date"];

/* Check if guest's reservation schedule falls inside an existing reservation schedule then
checking room availability if true */
// [START]
  // Check using arrival date as basis
  $sqlQuery = " SELECT * FROM `reservation`WHERE (arrival_date <= '$new_arrival_date' ) 
              ORDER BY arrival_date DESC LIMIT 1
  ";
  $res = $link->query($sqlQuery);
  while($row = mysqli_fetch_object($res))
  { 
    if($new_arrival_date >= $row->arrival_date && $new_departure_date <= $row->departure_date)
    {
      if(str_contains($row->room, '1')){ ++$r1_check; }
      if(str_contains($row->room, '2')){ ++$r2_check; }
      if(str_contains($row->room, '3')){ ++$r3_check; }
    } 
  }
  // Check using departure date as basis
  $sqlQuery = " SELECT * FROM `reservation`WHERE (departure_date >= '$new_departure_date' ) 
                ORDER BY departure_date DESC LIMIT 1
  ";
  $res = $link->query($sqlQuery);
  while($row = mysqli_fetch_object($res))
  { 
    if($new_arrival_date >= $row->arrival_date && $new_departure_date <= $row->departure_date)
    {
      if(str_contains($row->room, '1')){ ++$r1_check; }
      if(str_contains($row->room, '2')){ ++$r2_check; }
      if(str_contains($row->room, '3')){ ++$r3_check; }
    } 
  }
// [END]

// Check number of reservations with given dates from the user
$sqlQuery = " SELECT * FROM reservation WHERE 
              ((arrival_date BETWEEN '$new_arrival_date' AND '$new_departure_date') 
              OR 
              (departure_date BETWEEN '$new_arrival_date' AND '$new_departure_date')) 
";
$res = $link->query($sqlQuery);
while($row = mysqli_fetch_object($res))
{ 
  if(str_contains($row->room, '1')){ ++$r1_check; }
  if(str_contains($row->room, '2')){ ++$r2_check; }
  if(str_contains($row->room, '3')){ ++$r3_check; }
}
?>

<!-- MODAL CONTENT [START]-->
<div class="modal-header" style="background-color: #2b2b2b;">
    <h4 class="modal-title" style="color: white;">Available Rooms</h4>
</div>

<div class="modal-body" style="color: black;">

  <!-- HIDDEN INPUT FIELDS [START] -->
  <input type="text" id="gn" value="<?php echo($_POST["gn"]); ?>" hidden required>
  <input type="text" id="cn" value="<?php echo($_POST["cn"]); ?>" hidden required>
  <input type="email" id="em" value="<?php echo($_POST["e"]); ?>" hidden required>
  <input type="text" id="adr" value="<?php echo($_POST["adr"]); ?>" hidden required>
  <input type="number" id="gq" value="<?php echo($_POST["gq"]); ?>" hidden required>
  <input type="text" id="ad" value="<?php echo($_POST["arrival_date"]); ?>" hidden required>
  <input type="text" id="dd" value="<?php echo($_POST["departure_date"]); ?>" hidden required>
  <!-- HIDDEN INPUT FIELDS [END] -->

    <?php 
      if($r1_check == 0){
      echo
      ("
        <div class='card mb-2'>
        <div class='card-body'>
          <input type='checkbox' name='r1' id='r1' value='Room 1'> <b>Room 1</b><br/>
          <p>
            Cost per night: 1,600<br/>
            Good for 4 persons
          </p>
        </div>
        </div>
      ");
      }
      else{
      echo
      ("
      <input type='checkbox' name='r1' id='r1' value='Room 1' hidden>
      ");
      }
    ?>

    <?php 
      if($r2_check == 0){
      echo
      ("
        <div class='card mb-2'>
        <div class='card-body'>
          <input type='checkbox' name='r2' id='r2' value='Room 2'> <b>Room 2</b><br/>
          <p>
            Cost per night: 1,200<br/>
            Good for 3 persons
          </p>
        </div>
        </div>
      ");
      }
      else{
        echo
        ("
        <input type='checkbox' name='r2' id='r2' value='Room 2' hidden>
        ");
      }
    ?>

    <?php 
      if($r3_check == 0){
      echo
      ("
        <div class='card mb-2'>
        <div class='card-body'>
          <input type='checkbox' name='r3' id='r3' value='Room 3'> <b>Room 3</b><br/>
          <p>
            Cost per night: 1,000<br/>
            Good for 2 persons
          </p>
        </div>
        </div>
      ");
      }
      else{
        echo
        ("
        <input type='checkbox' name='r3' id='r3' value='Room 3' hidden>
        ");
      }
    ?>

    <?php 
      if($r1_check > 0 && $r2_check > 0 && $r3_check > 0)
      {
        echo
        ("
          <h2>No room available with your given schedule.</h2>
        ");
      }
      else
      {
        echo("
        <hr style='border-color:black'/>
        <h5>Remarks</h5>
        <input type='checkbox' name='remark1' id='remark1' value='Extra Bed'> <b>Extra Bed (Php 250)</b><br/>
        <input type='checkbox' name='remark2' id='remark2' value='Do Not Disturb'> <b>Do not disturb</b>
        <hr style='border-color:black'/>
        <h4 style='color:black;'>Your Reservation Details</h4>
        <div class='row'>
          <div class='col-sm'>
            Name: ".$_POST["gn"]."<br/>
            Contact Number: ".$_POST["cn"]."<br/>
            Email: ".$_POST["e"]."<br/>
            Address: ".$_POST["adr"]."<br/><br/>
          </div>
          <div class='col-sm'>
            Number of Guest: ".$_POST["gq"]."<br/>
            Arrival Date: ".$_POST["arrival_date"]."<br/>
            Departure Date: ".$_POST["departure_date"]."<br/>
            Length of stay: <span id='los'>".$los."</span> Day(s)<br/><br/>
            Reservation Cost: Php <span id='cost'>0</span><br/>
          </div>
        </div>
        ");
      }
    ?>
</div>

<div class="modal-footer">
  <button style="height:36px;border-radius:30px;" type="button" class="btn btn-dark" data-bs-dismiss="modal" formnovalidate>Close</button>
  <input style="height:36px;border-radius:30px;" type="submit" class="create_btn btn btn-info" value="Create New Reservation" <?php if($r1_check > 0 && $r2_check > 0 && $r3_check > 0){echo("disabled");} ?>>
</div>
<!-- MODAL CONTENT [END]-->

<!------------------ SCRIPT -------------------->
<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type='text/javascript'>
  // Room 1 Checkbox
  $(document).ready(function(){
    $('#r1').change(function(){
    ///////////////////////////
    var days = parseFloat(document.getElementById("los").textContent);
    var reservation_cost = parseFloat(document.getElementById("cost").textContent);
    if (document.getElementById("r1").checked == true)
    { 
      reservation_cost += (1600 * days);
      document.getElementById("cost").innerHTML = reservation_cost; 
    } 
    else
    { 
      reservation_cost -= (1600 * days);
      document.getElementById("cost").innerHTML = reservation_cost;  
    }
    ///////////////////////////
    });
  });

  // Room 2 Checkbox
  $(document).ready(function(){
    $('#r2').change(function(){
    ///////////////////////////
    var days = parseFloat(document.getElementById("los").textContent);
    var reservation_cost = parseFloat(document.getElementById("cost").textContent);
    if (document.getElementById("r2").checked == true)
    { 
      reservation_cost += (1200 * days);
      document.getElementById("cost").innerHTML = reservation_cost; 
    } 
    else
    { 
      reservation_cost -= (1200 * days);
      document.getElementById("cost").innerHTML = reservation_cost;  
    }
    ///////////////////////////
    });
  });

  // Room 3 Checkbox
  $(document).ready(function(){
    $('#r3').change(function(){
    ///////////////////////////
    var days = parseFloat(document.getElementById("los").textContent);
    var reservation_cost = parseFloat(document.getElementById("cost").textContent);
    if (document.getElementById("r3").checked == true)
    { 
      reservation_cost += (1000 * days);
      document.getElementById("cost").innerHTML = reservation_cost; 
    } 
    else
    { 
      reservation_cost -= (1000 * days);
      document.getElementById("cost").innerHTML = reservation_cost;  
    }
    ///////////////////////////
    });
  });

  // Remark 1 Checkbox
  $(document).ready(function(){
    $('#remark1').change(function(){
    ///////////////////////////
    var days = parseFloat(document.getElementById("los").textContent);
    var reservation_cost = parseFloat(document.getElementById("cost").textContent);
    if (document.getElementById("remark1").checked == true)
    { 
      reservation_cost += 250;
      document.getElementById("cost").innerHTML = reservation_cost; 
    } 
    else
    { 
      reservation_cost -= 250;
      document.getElementById("cost").innerHTML = reservation_cost;  
    }
    ///////////////////////////
    });
  });

  /* Create Reservation Button */
  $(document).ready(function(){
    $('.create_btn').click(function(){

      var gn = document.getElementById("gn").value;
      var cn = document.getElementById("cn").value;
      var em = document.getElementById("em").value;
      var adr = document.getElementById("adr").value;
      var gq = document.getElementById("gq").value;
      var ad = document.getElementById("ad").value;
      var dd = document.getElementById("dd").value;

      // Don't create reservation if no rooms were selected
      if( document.getElementById("r1").checked == false &&
          document.getElementById("r2").checked == false && 
          document.getElementById("r3").checked == false    )
      { 
        Swal.fire({
        icon: "error",
        title: "Cannot create reservation",
        html: 'Please select at least 1 room.'
        });
      }
      else
      {
        if(document.getElementById("r1").checked == true){ var r1 = 1; }
        else{ var r1 = 0; }
        if(document.getElementById("r2").checked == true){ var r2 = 1; }
        else{ var r2 = 0; }
        if(document.getElementById("r3").checked == true){ var r3 = 1; }
        else{ var r3 = 0; }
        if(document.getElementById("remark1").checked == true){ var remark1 = 1; }
        else{ var remark1 = 0; }
        if(document.getElementById("remark2").checked == true){ var remark2 = 1; }
        else{ var remark2 = 0; }

        console.log(r1);
        console.log(r2);
        console.log(r3);
        console.log(remark1);
        console.log(remark2);

        $.ajax
        ({
          url:'y_createReservation.php',
          type: 'post',
          data: {
            gn: gn,
            cn: cn,
            em: em,
            adr: adr,
            gq: gq,
            ad: ad,
            dd: dd,
            r1: r1,
            r2: r2,
            r3: r3,
            remark1: remark1,
            remark2: remark2
          },
          success: function(response)
          { 
            Swal.fire({
              title: "Reservation created succesfully",
              text: "Your reservation details is sent to your email (This function is still under development - SJ Las Marias, Lead Programmer)",
              icon: "success"
            }).then((result) => {
              if(result.isConfirmed){ window.location.href = "../crmci_new/hometel.html"; }
            });
          }
        }); 
      }
    });
  });

</script>