<!----- INITIALIZATION ON PAGE LOAD ----->
<?php 
  /*** --- Initialize --- ***/
  include 'zzz_Initialize.php';

?>

<!---------------------------------------------- HTML (START) ------------------------------------------------>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRMC Hometel | New Reservation</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Custom CSS ("Original" codes by the makers of this page) -->
    <link href="../crmci_new/assets/css/custom_style.css" rel="stylesheet">
    <script src="../crmci_new/assets/js/custom_script.js"></script>
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
</style>
<body onload="pageLoad()" style="background-color: rgb(7, 7, 44);">
  <!-- PAGE LOADER [START] -->
  <div class="page_loader-overlay">
  <div class="position-allMid" style="top:60.5%; left:50.8%;"><h2>Loading...</h2></div>
    <div class="spinner-border text-info" style="width:25px; height:25px;"></div>
    <br/>
  
  </div>
  <!-- PAGE LOADER [END] -->

  <!-- HEADER [START] -->
  <header class="container-fluid" style="background-color: rgb(7, 7, 44);">
    <nav class="navbar navbar-expand-lg navbar-dark">
  
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header_buttons">
        <span class="navbar-toggler-icon"></span>MENU
      </button>
  
      <a style="width: 10%;" href="hometel_index.php">
        <img style="width: 90%;" src="images/crmc_logo.png">
      </a>
  
      <div class="collapse navbar-collapse" id="header_buttons">
        <ul class="navbar-nav mx-auto noselect">
          <li class="m-2"><a href="index.html">Home</a></li>
          <li class="m-2"><a href="aboutUs.html">About us</a></li>
          <li class="m-2"><a href="c&p.html">Courses & Programs</a></li>
          <li class="m-2"><a href="enrollment.html">Enrollment</a></li>
          <li class="m-2"><a href="events.html">Events</a></li>
          <li class="m-2 current-page">Hometel</li>
          <li class="m-2"><a href="facilities.html">Facilities</a></li>
          <li class="m-2"><a href="administrators.html">Administrators</a></li>
          <li class="m-2"><a href="contactUs.html">Contact Us</a></li>
        </ul>
      </div>
  
    </nav>          
  </header>
  <!-- HEADER [END] -->

  <!-- Body Header / "Banner" [START] -->
  <div class="noselect" style="position: relative;">
      <div class="overlay-orange">
        <div class="pos_content-topleft">
          <span style="font-size: 4.02vw;"><b>CREATE RESERVATION</b></span><br/>
        </div>
      </div>
      <img style="width: 100%; height: auto;" src="images/headBG_hometel.png">
    </div>
    <!-- Body Header / "Banner" [END] -->

  <!----- FORM BODY [START] ----->
  <div class="container border border-dark rounded rounded-4 text-center" style="background-color:#e1f7e1; color:black; margin-top:2%; margin-bottom:2%;">
    <br/>
    <h1 class="text-center" style=" color:#030222; padding:2.5%;">CRMC HOMETEL ONLINE RESERVATION FORM</h1><br>
    <div class="row text-left">
      <!-- Left Side -->
      <div class="col-sm-6">
        <!-- Guest Name -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Name </label>
          <input type="text" class="form-control" id="gn" placeholder="Enter name" required>
        </div>
        <!-- Contact Number -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Contact Number</label>
          <input type="number" onKeyPress="if(this.value.length==11){ return false; }" class="form-control" id="cn" placeholder="Enter contact number" required>
        </div>
        <!-- Email -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Email</label>
          <input type="email" class="form-control" id="e" placeholder="Enter email" required>
        </div>
        <!-- Address -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Address</label>
          <input type="text" class="form-control" id="adr" placeholder="Enter address" required>
        </div>
      </div>

      <!-- Right Side -->
      <div class="col-sm-6">
        <!-- Number of Guests -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Number of guest</label>
          <input type="number" min="1" class="form-control" id="gq" value="1" required>
        </div>
        <!-- Arrival Date -->
          <div class="form-group mb-2 text-start">
            <label class="ps-2">Arrival Date</label>
            <input type="date" class="form-control" id="ad" required>
          </div>
        <!-- Departure Date -->
        <div class="form-group mb-2 text-start">
          <label class="ps-2">Departure Date</label>
          <input type="date" class="form-control" id="dd" required>
        </div>  
      </div>

    </div>
    <br/>
    <input type="submit" style="border-radius:30px;"class="room btn btn-success btn-lg mb-3" value="Check Room Availability">
    <br/>
  </div>

  <!----- FORM BODY [END] ----->

  <!-- FOOTER [START] -->
  <footer class="container-fluid" style="background-color: rgb(7, 7, 44);">
    <div class="container">
      <div class="row">

        <div class="col-sm"><!-- 1st Column [START] -->
          <h4 class="mb-4 mt-4" style="color: #E95C0E;">CEBU ROOSEVELT MEMORIAL COLLEGES</h4>
          <!-- Location -->
          <i class="fa-solid fa-location-dot" style="color: #ffffff;"></i>&nbsp;
          <label class="mb-3">San Vicente St., Bogo City, Cebu</label><br/>
          <!-- Phone -->
          <i class="fa-solid fa-phone" style="color: #ffffff;"></i>&nbsp;
          <label class="mb-3">438-8488</label><br/>
          <!-- Email -->
          <i class="fa-solid fa-envelope" style="color: #ffffff;"></i>&nbsp;
          <label class="mb-3">crmc.enrollement@gmail.com</label>
        </div><!-- 1st Column [END] -->

        <div class="col-sm"><!-- 2nd Column [START] -->
          <h5 class="mb-4 mt-4">QUICK NAVIGATION</h5>
          <ul class="noselect" style="list-style-type: none; padding: 0;">
            <li class="m-2"><a href="index.html">Home</a></li>
            <li class="m-2"><a href="aboutUs.html">About us</a></li>
            <li class="m-2"><a href="c&p.html">Courses & Programs</a></li>
            <li class="m-2"><a href="enrollment.html">Enrollment</a></li>
            <li class="m-2"><a href="events.html">Events</a></li>
            <li class="m-2 current-page">Hometel</a></li>
            <li class="m-2"><a href="facilities.html">Facilities</a></li>
            <li class="m-2"><a href="administrators.html">Administrators</a></li>
            <li class="m-2"><a href="contactUs.html">Contact Us</a></li>
          </ul>
        </div><!-- 2nd Column [END] -->

        <div class="col-sm "><!-- 3rd Column [START] -->
          <h5 class="mb-3 mt-4">CONNECT WITH US</h5>
          <div class="noselect">
            <!-- Facebook -->
            &nbsp;
            <a class="fa-brands fa-facebook fa-xl" href="https://www.facebook.com/crmcofficialpage/"></a>
            <!-- Twitter/X -->
            <span class="noselect">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <a class="fa-brands fa-twitter fa-xl" href="#"></a>
            <!-- Instagram -->
            <span class="noselect">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <a class="fa-brands fa-instagram fa-xl" href="#"></a>
          </div>
        </div><!-- 3rd Column [END] -->

        <div class="col-sm"><!-- 4th Column [START] -->
          <div class="mb-3 mt-5" style="position: relative;">
            <img style="opacity: 0.35; width: 100%; height: auto;" src="images/crmc_logo.png">
            <button class="btn btn position-allMid" style="background-color: #E95C0E; border-radius: 30px;"><a class="a-white" href="#">Enroll Now!</a></button>
          </div>
        </div><!-- 4th Column [END] -->

      </div>
    </div>
  </footer>
  <!-- FOOTER [END] -->

  <!-- MODAL FORMS [START] -->

  <!-- /// View Reservation Modal -->
  <div class="modal fade" id="BookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!--
        ***** Modal content provided by x_Booking.php *****
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
<!-- Page Loader Script -->
<script src="../crmci_new/assets/js/custom_script.js"></script>
<!-- Sweet Alert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  /* Disable past dates for the datepicker */
  $(document).ready(function(){
    var currentDay = new Date();
    var currentDay = (currentDay.getFullYear())+'-'+(currentDay.getMonth() + 1)+'-'+(currentDay.getDate());
    $('#ad').attr('min', currentDay);
    $('#dd').attr('min', currentDay);
  });

  /* Check Room Availability Button */
  $(document).ready(function(){
    $('.room').click(function(){

      var gn = document.getElementById("gn").value;
      var cn = document.getElementById("cn").value;
      var e = document.getElementById("e").value;
      var adr = document.getElementById("adr").value;
      var gq = document.getElementById("gq").value;
      var ad = document.getElementById("ad").value;
      var dd = document.getElementById("dd").value;

      // Don't check rooms if form is incomplete
      if(gn=="" || cn=="" || e=="" || adr=="" || gq=="" || ad=="" || dd=="")
      { 
        Swal.fire({
        icon: "error",
        title: "Cannot check room availability",
        html: 'Please fill up the reservation form.'
        });
      }
      else if(cn.length < 11)
      { 
        Swal.fire({
        icon: "error",
        title: "Cannot check room availability",
        html: 'Enter a valid phone number.'
        });
      }
      else
      {
        // ---------- Check if Arrival Date is greater than Departure Date
        if(ad > dd) // Do not check room availability if it is true. Display a message to notify the user.
        { 
          Swal.fire({
          icon: "error",
          title: "Cannot check room availability",
          html: 'The arrival date must not be ahead of the departure date.'
          });
        }

        // ---------- Check if Arrival Date is the same as Departure Date
        else if(ad == dd) // Do not check room availability if it is true. Display a message to notify the user.
        { 
          Swal.fire({
          icon: "error",
          title: "Cannot check room availability",
          html: 'The arrival date and departure date must not be the same.'
          });
        }

        else
        {
          $.ajax
          ({
            url:'x_Booking.php',
            type: 'post',
            data: {
              gn: gn,
              cn: cn,
              e: e,
              adr: adr,
              gq: gq,
              arrival_date: ad,
              departure_date: dd
            },
          success: function(response)
          { 
            $('.modal-content').html(response); 
            $('#BookingModal').modal('show');   
          }
        });
        }
      }
    });
  });

</script>