<?php
  // Establish Connection to SQL Database
  $servername="localhost";
  $username="root";
  $password="";
  $dbname="capstone_db"; // <--- Name of Database to connect with
  $link=mysqli_connect($servername,$username,$password,$dbname);
  $con=mysqli_select_db($link,$dbname);

  // OB & Session start
  ob_start();
  session_start();
?>