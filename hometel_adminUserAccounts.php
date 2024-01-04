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
    <title>CRMC Hometel Management | User Accounts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- JQUERY -->
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

  <h2 class="noselect"> Manage User Accounts</h2>
  <hr style="border-color: black;"/>
  <div class="container-fluid">
    <p style="font-size:17px;" class="noselect">
      This page displays all user accounts from the database, click <button style="height:36px;border-radius:30px;"class="btn btn-success">Create</button> 
      to create a new account, <button style="height:36px;border-radius:30px;"class="btn btn-warning">View</button> to view the details of the selected account,
      <button style="height:36px;border-radius:30px;" class="btn btn-info">Edit</button> to edit the account and <button style="height:36px;border-radius:30px;"class="btn btn-danger">Delete</button>
      to delete the account.
      </p>
  </div>
  <hr style="border-color: black;"/>
  <!-- Table -->
  <div class="col-sm-12"><!-- Div for Table (Start) -->
      <table class="table table-striped table-bordered text-center noselect" id="accountTable">
        <thead class="table-dark"> 
          <tr>
            <th class="align-middle" scope="col">User</th>
            <th class="align-middle" scope="col">Account Type</th>
            <th class="align-middle" scope="col">
              Actions &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button style="height:36px;border-radius:30px;" data-id="0" class="createAccount btn btn-success">Create</button>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $sqlQuery = " SELECT * FROM account ";
            $res = $link->query($sqlQuery);
            while($row = mysqli_fetch_object($res)){
          ?>
          <tr>
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->type; ?></td>
            <td>
              <button style="height:36px;border-radius:30px;"data-id='<?php echo $row->id; ?>' class="viewAccount btn btn-warning">View</button>
              &nbsp;    
              <button style="height:36px;border-radius:30px;" data-id='<?php echo $row->id; ?>' class="editAccount btn btn-info">Edit</button>
              &nbsp;    
             <?php 
              if($_SESSION['name']==$row->name)
              { 
                echo "<button data-id='".$row->id."' class='deleteAccount btn btn-danger' disabled style='border-radius:30px;height:36px;'>Delete</button>"; 
              }
              else
              { 
                echo "<button data-id='".$row->id."' class='deleteAccount btn btn-danger' style='border-radius:30px;height:36px;'>Delete</button>";
              }
              ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
  </div><!-- Div for Table (END) -->
  
  </div>
  <!----- MAIN BODY [END] ----->
  </div>

  <!-- MODAL FORMS [START] -->

  <!-- /// Create Account Modal -->
  <div class="modal fade" id="createAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_addAccount.php *****
        -->
        </div>
      </div>
    </div>
  </div>

  <!-- /// View Account Modal -->
  <div class="modal fade" id="viewAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_viewAccount.php *****
        -->
        </div>
      </div>
    </div>
  </div>

  <!-- /// Edit Account Modal -->
  <div class="modal fade" id="editAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_editAccount.php *****
        -->
        </div>
      </div>
    </div>
  </div>

  <!-- /// Delete Account Modal -->
  <div class="modal fade" id="deleteAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_deleteAccount.php *****
        -->
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL FORMS [END] -->
</body>
</html>
<!----------------------------------------------- HTML (END) ------------------------------------------------->

<!------------------ SCRIPT -------------------->
<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type='text/javascript'>
  // Datatable
  new DataTable('#accountTable');

  // CREATE ACCOUNT Modal
  $(document).ready(function(){
    $('.createAccount').click(function(){
      var dummy_id = $(this).data('id');
      $.ajax
      ({
        url: 'x_addAccount.php',
        type: 'post',
        data: {id: dummy_id},
        success: function(response){ 
          $('.modal-content').html(response); 
          $('#createAccountModal').modal('show'); 
        }
      });
    });
  });

  // VIEW ACCOUNT Modal
  $(document).ready(function(){
    $('.viewAccount').click(function(){
      var account_id = $(this).data('id');
      $.ajax
      ({
        url:'x_viewAccount.php',
        type: 'post',
        data: {id: account_id},
        success: function(response){ 
          $('.modal-content').html(response); 
          $('#viewAccountModal').modal('show'); 
        }
      });
    });
  });

  // EDIT ACCOUNT Modal
  $(document).ready(function(){
    $('.editAccount').click(function(){
      var account_id = $(this).data('id');
      $.ajax
      ({
        url:'x_editAccount.php',
        type: 'post',
        data: {id: account_id},
        success: function(response){ 
          $('.modal-content').html(response); 
          $('#editAccountModal').modal('show'); 
        }
      });
    });
  });

  // DELETE ACCOUNT Modal
  $(document).ready(function(){
    $('.deleteAccount').click(function(){
      var account_id = $(this).data('id');
      $.ajax
      ({
        url:'x_deleteAccount.php',
        type: 'post',
        data: {id: account_id},
        success: function(response){ 
          $('.modal-content').html(response); 
          $('#deleteAccountModal').modal('show'); 
        }
      });
    });
  });

</script>

<!------------------------------------------------- PHP ------------------------------------------------------>

<?php /*** --- Button Functions --- */
  // Create Button
  if(isset($_POST["create_btn"]))
  {
    $duplicate = 0; // check Username duplicate
    $duplicate2 = 0; // check if person already has an account

    // check username duplicate in user account list
    $res=mysqli_query($link,"select * from account where username='$_POST[un]'");
    while($row=mysqli_fetch_array($res))
    {   
        if($row["username"] == $_POST["un"])
        { $duplicate = 1; }   
    }
    // check username duplicate in verification list
    $res=mysqli_query($link,"select * from account where name='$_POST[nm]'");
    while($row=mysqli_fetch_array($res))
    {   
        if($row["name"] == $_POST["nm"])
        { $duplicate2 = 1; }   
    }

    if(($duplicate == 0) && ($duplicate2 == 0)){
    $sqlQuery = " INSERT INTO account VALUES
    (
    DEFAULT, 
    '$_POST[un]', 
    '$_POST[pw]', 
    '$_POST[t]', 
    '$_POST[nm]', 
    '$_POST[em]',
    '$_POST[ad]',
    '$_POST[cn]'
    ) ";
    $res = $link->query($sqlQuery);

    // Save action to the Database
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    $time = date("h:i:s a");
    $action = "Create Account";
    $log = "[".$_SESSION['id']."] ".$_SESSION['name']." (".$_SESSION['type'].") | Created a new account for ".$_POST['nm']." (".$_POST['t'].").";
    $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
    $res = $link->query($sqlQuery);

    header('Location: hometel_adminUserAccounts.php');
    ob_end_flush();
    }
    else{
      echo'
        <script>
        Swal.fire({
        icon: "error",
        title: "Cannot create new account",
        html: "The user might already have an account or username is already taken."
        });
        </script>
      ';
    }
  }

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

      header('Location: hometel_adminUserAccounts.php');
      ob_end_flush();
    }
  }

  // Delete Button
  if(isset($_POST["delete_btn"]))
  {
    // Select account to be deleted (For recording in the history log)
    $Name = '';
    $Type = '';
    $sqlQuery ="SELECT * FROM account WHERE id= $_POST[delete_btn]";
    $res = $link->query($sqlQuery);
    while($row=mysqli_fetch_array($res))
    {
      $Name = $row["name"];
      $Type = $row["type"];
    }

    $sqlQuery = " DELETE FROM account WHERE id = $_POST[delete_btn] ";
    $res = $link->query($sqlQuery);

    // Save action to the Database
    date_default_timezone_set("Asia/Manila");
    $date = date("Y-m-d");
    $time = date("h:i:s a");
    $action = "Delete Account";
    $log = "[".$_SESSION['id']."] ".$_SESSION['name']." (".$_SESSION['type'].") | Deleted the account of [".$_POST['delete_btn']."] ".$Name." (".$Type.").";
    $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
    $res = $link->query($sqlQuery);

    header('Location: hometel_adminUserAccounts.php');
    ob_end_flush();
  }

?>
