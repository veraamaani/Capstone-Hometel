<?php /*** --- Initialize --- ***/
  include 'zzz_Initialize.php';

  // If user is not logged in, redirect to 'CRMC Hometel Management | Login' page
  if(isset($_SESSION['name'])==0){ header('Location: hometel_login.php'); }

  /* Automatic cancellation of pending reservation [START] */
    // Count the number of pending reservation to delete automatically
    $current_date = date("Y-m-d");
    $expired_reservation_count = 0;    
    $sqlQuery ="SELECT * FROM reservation WHERE (arrival_date < '$current_date') AND (status = 'Pending') ";
    $res = $link->query($sqlQuery);
    while($row=mysqli_fetch_array($res))
    {
      ++$expired_reservation_count;
    }
    // Store selected reservation from above for recording purposes
    $index = -1;
    $sqlQuery ="SELECT * FROM reservation WHERE (arrival_date < '$current_date') AND (status = 'Pending') ";
    $res = $link->query($sqlQuery);
    while($row=mysqli_fetch_object($res))
    {
      ++$index;
      $selected_gn = array_fill($index, $expired_reservation_count, $row->guest_name);
    }
    // Save action to the Database
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    for($x=0; $x<$expired_reservation_count; ++$x)
    {
      $time = date("h:i:s a");
      $action = "Cancel Reservation";
      $log = "System | Automatically Cancelled the reservation of ".$selected_gn[$x];
      $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
      $res = $link->query($sqlQuery);
    }
    // Automatically Cancel Reservation
      $sqlQuery = " DELETE FROM reservation WHERE (arrival_date < '$current_date') AND (status = 'Pending') ";
      $res = $link->query($sqlQuery);
  /* Automatic cancellation of pending reservation [END] */
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
    <title>CRMC Hometel Management | Index</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Datatable -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Custom CSS ("Original" CSS codes by the makers of this page) -->
    <link href="zzz_hometelStyle.css" rel="stylesheet">
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
      <button class="custom_btn1"  name="verifyPending_btn"><i class="fa-regular fa-calendar"></i>&nbsp;Reservation</button>
      <button class="custom_btn1"  name="viewReservation_btn"><i class="fa-regular fa-calendar-check"></i>&nbsp;Confirmed Reservation</button>
      <button class="custom_btn1"  name="generateReport_btn"><i class="fa-solid fa-file-invoice"></i>&nbsp;Generate Report</button>
      <button class="custom_btn1"  name="history_btn"><i class="fa-regular fa-clock"></i>&nbsp;View History</button>
      <button class="custom_btn1"  name="logout_btn"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;Logout</button>
    </form>  
     
  </div>
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


  <!----- NAVIGATION/HEADER BAR [END] ----->

  <!----- MAIN BODY [START] ----->
  <div class="col offset-3 p-3">

  <h1 class="noselect">
    Welcome <?php echo($_SESSION['name']); ?>
  </h1>
  <hr style="border: 1px solid black;"/>

  <!-- BS Cards [START] -->
  <div class="row">
  <!--------------------------------------------------->
  <?php
  if($_SESSION['type']=="Admin")
  {
    $accountCount = 0;
    $sqlQuery = " SELECT * FROM account";
    $res = $link->query($sqlQuery);
    while($row = mysqli_fetch_object($res)){ ++$accountCount; }
    echo("
      <div class='col-sm-6 mb-3'>
      <div class='card'>
        <div class='card-body'>
          <h5 class='card-title'>Number of User Accounts</h5>
          <h1>".$accountCount."</h1>
        </div>
      </div>
      </div>
    ");
  }
  ?>

    <div class="col-sm-6 mb-3">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Number of Pending Reservation</h5>
          <?php
            $pendingreservationCount = 0;
            $sqlQuery = " SELECT * FROM reservation WHERE status='Pending'";
            $res = $link->query($sqlQuery);
            while($row = mysqli_fetch_object($res)){ ++$pendingreservationCount; }
            echo("<h1>".$pendingreservationCount."</h1>");
          ?>
        </div>
      </div>
    </div>
  <!--------------------------------------------------->
  </div>
  <!-- BS Cards [END] -->
  <!-- All activities of the day [START] -->
  <hr style="border: 1px solid black;"/>
  <p class="noselect mb-3" style="font-size:30px;">
    Recent Activities
</p>
  

  <!-- Table -->
  <div class="col-sm-12"><!-- Div for Table (Start) -->
      <table class="table table-striped table-bordered" id="historyTable">
        <thead class="table-dark text-center noselect">
          <tr class="align-middle">
            <th>Log Number</th>
            <th>Date (Year-Month-Day)</th>
            <th>Time</th>
            <th>Action</th>
            <th>Log</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $currentDay = date("Y-m-d");
            $sqlQuery = " SELECT * FROM history WHERE date='$currentDay' ORDER BY id DESC ";
            $res = $link->query($sqlQuery);
            while($row = mysqli_fetch_object($res)){
          ?>
          <tr>
            <td class="text-center"> <?php echo $row->id; ?></td>
            <td class="text-center"> <?php echo $row->date; ?></td>
            <td class="text-center"> <?php echo $row->time; ?></td>
            <td class="text-center"> <?php echo $row->action; ?></td>
            <td> <?php echo $row->log; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
  </div><!-- Div for Table (END) -->
  <span class="noselect"><br/></span>
  <!-- All activities of the day [END] -->
  <style>
  .card{
    background-color:  #0e1521;
    
  
    color: #e1f7e1;
    border-radius:15px ;
    border: 0px
    
  }
</style>

  </div>
  


  
  <!----- MAIN BODY [END] ----->

  </div>

</body>
</html>
<!----------------------------------------------- HTML (END) ------------------------------------------------->