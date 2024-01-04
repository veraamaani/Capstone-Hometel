<?php /*** --- Initialize --- ***/
  include 'zzz_Initialize.php';

  // If user is not logged in, redirect to 'CRMC Hometel Management | Login' page
  if(isset($_SESSION['name'])==0){ header('Location: hometel_login.php'); }
?>

<?php /*** --- Nav Bar Button Codes --- ***/
  // Manage User Account button (admin)
  if(isset($_POST["adminAccount_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_adminUserAccounts.php');
  }

  // Manage User Account button (staff)
  if(isset($_POST["staffAccount_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_staffUserAccounts.php');
  }

  // Verify Pending Reservation button
  if(isset($_POST["verifyPending_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_Reservation.php');
  }

  // View Reservation Button
  if(isset($_POST["viewReservation_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_confirmedReservation.php');
  }

  // Generate Report Button
  if(isset($_POST["generateReport_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_generateReport.php');
  }

  // View History Button
  if(isset($_POST["history_btn"]))
  {
    ob_end_flush();
    header('Location: hometel_history.php');
  }

  // Logout button
  if(isset($_POST["logout_btn"]))
  {
    session_destroy();
    ob_end_flush();
    header('Location: hometel_login.php');
  }
?>

<!---------------------------------------------- HTML (START) ------------------------------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC Hometel Management | Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
    <!-- Jspdf Autotable -->
    <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS ("Original" CSS codes by the makers of this page) -->
    <link href="zzz_hometelStyle.css" rel="stylesheet">
    <!-- Datatable -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<style>
  body {
    font-family: 'Poppins', sans-serif; 
  }
.noselect{ /* Prevent Text Highlight */
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Old versions of Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
}
.navbar-nav > li{ /* Set spacing for the items in the navigation/header bar */
  margin: 0.75%;
}
</style>
<body style="background:#e1f7e1;">
<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <div class="row g-0">
  <!----- NAVIGATION/HEADER BAR [START] ----->
  <div class="col-3" style="position:fixed; background-color: #0e1521; height:100vh;">
    <a class="mt-3 d-flex justify-content-center" class="p-1" style="width: 100%;" href="hometel_index.php">
      <img style="width: 40%; height: auto;" src="images/crmc_logo.png">
    </a><br/>
    <form class="d-flex flex-column" method="post">
      <?php
        if($_SESSION['type']=="Admin"){ echo "<button class='custom_btn1' name='adminAccount_btn'><i class='fa-solid fa-user-group'></i>&nbsp;Manage User Accounts</button>"; }
        else{ echo "<button class='custom_btn1' name='staffAccount_btn'><i class='fa-solid fa-user'></i>&nbsp;Manage User Account</button>"; }
      ?>
      <button class="custom_btn1" name="verifyPending_btn"><i class="fa-regular fa-calendar"></i>&nbsp;Reservation</button>
      <button class="custom_btn1" name="viewReservation_btn"><i class="fa-regular fa-calendar-check"></i>&nbsp;Confirmed Reservation</button>
      <button class="custom_btn1" name="generateReport_btn"><i class="fa-solid fa-file-invoice"></i>&nbsp;Generate Report</button>
      <button class="custom_btn1" name="history_btn"><i class="fa-regular fa-clock"></i>&nbsp;View History</button>
      <button class="custom_btn1" name="logout_btn"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;Logout</button>
    </form>   
  </div>
  <!----- NAVIGATION/HEADER BAR [END] ----->
  <style>
        /* Define the default style for the dashboard element */
        .custom_btn1 {
            Default color */

  transition: background-color 0.3s ease; 
  height: 50px;
  padding:5px;
  margin:8px;
  font-size:20px;
        }

        /* Change the color on hover */
        .custom_btn1:hover{
            background-color: #798fb5; /* New color on hover */
            height: 50px;
            

        }
    </style>
  <!----- MAIN BODY [START] ----->
  <div class="col offset-3 p-3">

  <h2 class="noselect">Generate Report</h2>
  <hr style="border-color: black;"/>
  <div class="container-fluid">
    <p style="font-size:17px;" class="noselect">
      This page allows you to generate a pdf that contains a "report" about the confirmed reservations,
      Select the year and month then click <button style="height:36px;border-radius:30px;"class="btn btn-info">Generate Report</button> to generate
      a report of the selected time period then click <button style="height:36px;border-radius:30px;" class="btn btn-success">Save</button> to
      save the generated report as pdf.
      </p>
  </div>
  <hr style="border-color: black;"/>
  <!-- "Form" -->
  <div class="form-group mb-2">

    &nbsp;Select Month<br/>
    <select id="m">
      <option value="January">January</option>
      <option value="February">February</option>
      <option value="March">March</option>
      <option value="April">April</option>
      <option value="May">May</option>
      <option value="June">June</option>
      <option value="July">July</option>
      <option value="August">August</option>
      <option value="September">September</option>
      <option value="October">October</option>
      <option value="November">November</option>
      <option value="December">December</option>
   </select><br/><br/>

    &nbsp;Select Year<br/>
    <input type="number" min="2000" id="y"><br/><br/><br/>

    &nbsp;&nbsp;&nbsp;<button style="height:36px;border-radius:30px;" class="generateReport btn btn-info">Generate Report</button>

  </div>
  </div>
  <!----- MAIN BODY [END] ----->
  </div>

  <!-- MODAL FORMS [START] -->

  <!-- /// Generate Report Modal -->
  <div class="modal fade" id="generateReportModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_generateReport.php *****
        -->
        </div>
      </div>
    </div>
  </div>
  

</body>
</html>
<!----------------------------------------------- HTML (END) ------------------------------------------------->

<!------------------ SCRIPT -------------------->
<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type='text/javascript'>

  // GENERATE REPORT Modal
  $(document).ready(function(){
    $('.generateReport').click(function(){

      var m = document.getElementById("m").value; // Month
      var y = document.getElementById("y").value; // Year

      if(y=="")
      { 
        Swal.fire({
        icon: "error",
        title: "Cannot generate report",
        html: 'Incomplete input, please select a year.'
        });
      }
      
      else
      {
        var sd = y; // Start date (For making query in getting reservations based on month and year)
        var ed = y; // End date (For making query in getting reservations based on month and year)
        
        switch(m)
        {
          case "January":   sd = y+"-1-1";   ed = y+"-1-31";    break;
          case "February":  sd = y+"-2-1";   ed = y+"-2-29";    break;
          case "March":     sd = y+"-3-1";   ed = y+"-3-31";    break;
          case "April":     sd = y+"-4-1";   ed = y+"-4-30";    break;
          case "May":       sd = y+"-5-1";   ed = y+"-5-31";    break;
          case "June":      sd = y+"-6-1";   ed = y+"-6-30";    break;
          case "July":      sd = y+"-7-1";   ed = y+"-7-31";    break;
          case "August":    sd = y+"-8-1";   ed = y+"-8-31";    break;
          case "September": sd = y+"-9-1";   ed = y+"-9-30";    break;
          case "October":   sd = y+"-10-1";  ed = y+"-10-31";   break;
          case "November":  sd = y+"-11-1";  ed = y+"-11-30";   break;
          case "December":  sd = y+"-12-1";  ed = y+"-12-31";   break;
        }

        $.ajax
        ({
          url: 'x_generateReport.php',
          type: 'post',
          data: {
            month: m, 
            year: y,
            start_date: sd,
            end_date: ed
          },
          success: function(response){ 
            $('.modal-content').html(response); 
            $('#generateReportModal').modal('show'); 
          }
        });
      }

    });
  });

</script>

