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
    <title>CRMC Hometel Management | User Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
  <div class="col-3" style="position:fixed;  background-color: #0e1521; height:100vh;">
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

  <h2 class="noselect">Manage User Account</h2>
  <hr style="border-color: black;"/>
  <div class="container-fluid">
    <p style="font-size:17px;" class="noselect">
      This page displays your personal information and account information. To make new changes
      to the displayed information, select the textbox of the information that you want to change and type
      the new datum then press <button style="height:36px;border-radius:30px;"class="btn btn-success">Edit Account Information</button> 
      to save all the changes that you made. (You'll be redirected to the index page after saving
      the changes.)
      </p>
  </div>
  <hr style="border-color: black;"/>
  <!-- Form -->
<?php
$sqlQuery = " SELECT * FROM account WHERE id=".$_SESSION['id'];
$res = $link->query($sqlQuery);

while($row = mysqli_fetch_object($res))
{
?>
  <div class="container-fluid noselect" style="color: black;">
    <div class="row">
      <!-- Left Side -->
      <div class="col-6">
        <h4>Personal Information</h4>
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" id="nm" placeholder="Enter fullname" value="<?php echo $row->name; ?>" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" id="em" placeholder="Enter email" value="<?php echo $row->email; ?>" required>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" id="ad" placeholder="Enter address" value="<?php echo $row->address; ?>" required>
        </div>
      </div>
      <!-- Right Side -->
      <div class="col-6">
        <h4>Account Information</h4>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" id="un" placeholder="Enter username" value="<?php echo $row->username; ?>" required>
        </div>
        <div class="form-group mb-5">
          <label>Password</label>
          <input type="text" class="form-control" id="pw" placeholder="Enter password" value="<?php echo $row->password; ?>" required>
        </div>
        <div class="form-group text-center">
          <input type="submit" style="height:50px;border-radius:30px;" class="confirmStaffEdit btn btn-lg btn-success" data-id='<?php echo $row->id; ?>' value="Edit Account Information">
        </div>
      </div>
    </div>
  </div>
<?php } ?>
<br/>

  </div>
  <!----- MAIN BODY [END] ----->
  </div>

  <!-- MODAL FORMS [START] -->

  <!-- /// Confirm Staff Edit Account Modal -->
  <div class="modal fade" id="confirmStaffEditAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_confirmStaffEditAccount.php *****
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

  $(document).ready(function(){
    $('.confirmStaffEdit').click(function(){
    //////////////////////////////////////////////////
      var nm = document.getElementById("nm").value;
      var em = document.getElementById("em").value;
      var ad = document.getElementById("ad").value;
      var un = document.getElementById("un").value;
      var pw = document.getElementById("pw").value;
      var id = $(this).data('id');

      if(nm==""||em==""||ad==""||un==""||pw==""||id=="")
      { 
        alert("Cannot edit account. Make sure all input fields are filled up."); 
      }
      else
      {
        $.ajax
        ({
          url:'x_confirmStaffEditAccount.php',
          type: 'post',
          data: {
            nm: nm,
            em: em,
            ad: ad,
            un: un,
            pw: pw,
            id: id
          },
          success: function(response)
          { 
            $('.modal-content').html(response); 
            $('#confirmStaffEditAccountModal').modal('show');   
          }
        });
      }
    //////////////////////////////////////////////////
    });
  });

</script>

<!------------------------------------------------- PHP ------------------------------------------------------>

<?php /*** --- Button Functions --- */

  // Edit Button
  if(isset($_POST["edit_btn"]))
  {
    $duplicate = 0; // check Username duplicate
    $duplicate2 = 0; // check if person already has an account

    // check username duplicate in user account list
    $res=mysqli_query($link,"select * from account where username='$_POST[un]'");
    while($row=mysqli_fetch_array($res))
    {   
        if(($row["username"] == $_POST["un"]) && ($_POST["old_un"] != $_POST["un"]))
        { $duplicate = 1; }   
    }
    // check username duplicate in verification list
    $res=mysqli_query($link,"select * from account where name='$_POST[nm]'");
    while($row=mysqli_fetch_array($res))
    {   
        if(($row["name"] == $_POST["nm"]) && ($_POST["old_nm"] != $_POST["nm"]))
        { $duplicate2 = 1; }   
    }

    if(($duplicate == 1))
    {
      echo'
        <script>
        Swal.fire({
        icon: "error",
        title: "Cannot edit account",
        html: "The username is already taken."
        });
        </script>
      ';
    }
    else if(($duplicate2 == 1))
    {
      echo'
        <script>
        Swal.fire({
        icon: "error",
        title: "Cannot edit account",
        html: "The user already have an existing account."
        });
        </script>
      ';
    }
    else
    {
      if($_SESSION['id'] == $_POST["edit_btn"]){ $_SESSION['name'] = $_POST["nm"]; }
      $sqlQuery = " UPDATE account SET 
        username='$_POST[un]', 
        password='$_POST[pw]', 
        type='$_POST[t]', 
        name='$_POST[nm]', 
        email='$_POST[em]',
        address='$_POST[ad]',
        contact_number='$_POST[cn]'
      WHERE id = '$_POST[edit_btn]' ";
      $res = $link->query($sqlQuery);

     // Save action to the Database
      date_default_timezone_set("Asia/Manila");
      $date = date("Y-m-d");
      $time = date("h:i:s a");
      $action = "Edit Account";
      $log = "[".$_SESSION['id']."] ".$_SESSION['name']." (".$_SESSION['type'].") | Edited the account of [".$_POST['edit_btn']."] ".$_POST['nm']." (".$_POST['t'].").";
      $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
      $res = $link->query($sqlQuery);

      header('Location: hometel_staffUserAccounts.php');
      ob_end_flush();
    }
  }

?>

