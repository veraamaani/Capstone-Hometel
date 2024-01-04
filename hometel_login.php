<?php /*** --- Initialize --- ***/
  include 'zzz_Initialize.php';

  // If user has already logged in, redirect to 'CRMC Hometel Management | Index' page
  if(isset($_SESSION['name'])){ header('Location: hometel_index.php'); }
?>

<!---------------------------------------------- HTML (START) ------------------------------------------------>
<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRMC Hometel Management | Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
body{
  /*background: linear-gradient(150deg, rgb(5,5,30) 35%, rgb(233,92,14) 100%);*/
  background: linear-gradient(-45deg, #23d5ab, #083975, #13caeb,  #1448e3, #23a6d5, #23d5ab);  height: 100vh;
  animation: custom_bg_animation 15s ease infinite;
  height: 100vh;
  background-size: 400% 400%;
}
@keyframes custom_bg_animation {
  0% { background-position: 0% 50%; }
	50% { background-position: 100% 50%; }
	100% { background-position: 0% 50%; }
}
</style>
<body>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
  <!-- "Body" [START] -->
<div class="container-fluid text-center noselect">
  <label class="mb-1"> </label><br><br>
  <img class="mb-1 img-fluid" style="height: 20%; width: 13.5%;" src="images\crmc_logo.png"><br>
  <br>
  <div class="justify-content-md-center col-lg-6 container border rounded border-light bg-light" style="width:50%;"> <!-- Login Form Container (start) -->
    <br>
    <h1 class="mb-2" style="color: #0e1521; font-size: 20px; font-family:poppins; font-weight:bold;" >CRMC Hometel Management System</h1> <!-- Inserted heading --><br>

    <form autocomplete="off" method="post"> <!-- Form (Start)-->
      <label class="mb-1">Username</label><br>
      <input class="mb-3" type="text" required name="username"><br>
<!-- input fields -->
<label class="mb-1">Password</label><br>
<input class="mb-3" type="password" required name="password" id="password"><br>
      
      <!-- checkbox for hiding/unhiding the password -->
<input type="checkbox" id="showPassword"> Show Password

<script>
  // JS toggle password visibility
  const showPasswordCheckbox = document.getElementById('showPassword');
  const passwordField = document.getElementById('password');

  showPasswordCheckbox.addEventListener('change', function() {
    passwordField.type = this.checked ? 'text' : 'password';
  });
</script>

<br><br>
<input type="submit" style="border-radius:30px; height:50px; font-size:20px; text-align:center;font-family:poppins;" class="btn btn-info btn-lg mb-3" name="login_btn" value="Login"><br>


    </form> <!-- Form (END)-->
  </div> <!-- Login Form Container (end) -->
  <br>
</div>
<!-- "Body" [END] -->

  <!-- "Body" [END] -->

</body>
</html> 
<!----------------------------------------------- HTML (END) ------------------------------------------------->

<!------------------ SCRIPT -------------------->
<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!------------------------------------------------- PHP ------------------------------------------------------>

<?php /*** --- Button Functions --- */
  // Login Button
  if(isset($_POST["login_btn"]))
  {
      $inputUser = htmlentities($_POST['username']);
      $inputPassword = htmlentities($_POST['password']);
      $res=mysqli_query($link,"select * from account where username='$_POST[username]' AND password='$_POST[password]'");
      while($row=mysqli_fetch_array($res))
      {
          if($inputUser == $row["username"] && $inputPassword == $row["password"]) // If login succeeds...
          { 
            // Set session variables
            $_SESSION['id'] = $row["id"];
            $_SESSION['username'] = $row["username"];
            $_SESSION['name'] = $row["name"];
            $_SESSION['type'] = $row["type"];
              
            // Save action to the Database
            date_default_timezone_set("Asia/Manila");
            $date = date("Y-m-d");
            $time = date("h:i:s a");
            $action = "Login";
            $log = "[".$_SESSION['id']."] ".$_SESSION['name']." (".$_SESSION['type'].") | Logged in.";
            $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
            $res = $link->query($sqlQuery);

            // Go to the "index page" for the CRMC Hometel Online Reservation system
            header('Location: hometel_index.php');
            ob_end_flush();
          }
      }
      // When login fails, display notification for the user
      echo'
        <script>
        Swal.fire({
        icon: "error",
        title: "Login Failed",
        html: "Username or password is incorrect."
        });
        </script>
      ';   
  }
?>