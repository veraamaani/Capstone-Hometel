<?php include 'zzz_Initialize.php'; ?>
<?php
      // ---------- Combine strings for the rooms
        // Room 1, Room 2, Room 3 SELECTED
        if($_POST["r1"] == 1 && $_POST["r2"] == 1 && $_POST["r3"] == 1)
        { $room = "Room 1 Room 2 Room 3";}
        // Room 1 SELECTED
        else if($_POST["r1"] == 1 && $_POST["r2"] == 0 && $_POST["r3"] == 0)
        { $room = "Room 1"; }
        // Room 2 SELECTED
        else if($_POST["r1"] == 0 && $_POST["r2"] == 1 && $_POST["r3"] == 0)
        { $room = "Room 2"; }
        // Room 3 SELECTED
        else if($_POST["r1"] == 0 && $_POST["r2"] == 0 && $_POST["r3"] == 1)
        { $room = "Room 3"; }
        // Room 1, Room 2 SELECTED
        else if($_POST["r1"] == 1 && $_POST["r2"] == 1 && $_POST["r3"] == 0)
        { $room = "Room 1 Room 2";}
        // Room 1, Room 3 SELECTED
        else if($_POST["r1"] == 1 && $_POST["r2"] == 0 && $_POST["r3"] == 1)
        { $room = "Room 1 Room 3";}
        // Room 2, Room 3 SELECTED
        else if($_POST["r1"] == 0 && $_POST["r2"] == 1 && $_POST["r3"] == 1)
        { $room = "Room 2 Room 3";}

      // ---------- Calculate length of stay 
        $dd_value = strtotime($_POST["dd"]);
        $ad_value = strtotime($_POST["ad"]);
        $los =  $dd_value - $ad_value;
        $los = floor($los/(60*60*24));
      
      // ---------- Calculate cost
        $cost = 0;
        if($_POST["r1"] == 1){ $cost += 1600;  }
        if($_POST["r2"] == 1){ $cost += 1200;  }
        if($_POST["r3"] == 1){ $cost += 1000;  }
        if($_POST["remark1"] == 1){ $cost += 250;  }
        $cost *= $los;

      // ---------- Combine strings for remark
      $remark = "";
      if($_POST["remark1"] == 0 && $_POST["remark2"] == 0){ $remark = "None"; }
      if($_POST["remark1"] == 1){ $remark = $remark."Extra Bed"." "; }
      if($_POST["remark1"] == 1 && $_POST["remark2"] == 1){ $remark = $remark."|"." "; }
      if($_POST["remark2"] == 1){ $remark = $remark."Do Not Disturb"." "; } 

      // ---------- Save new reservation to the database
        $payment_received = 0;
        $payment_change = 0;
        $sqlQuery = " INSERT INTO reservation VALUES 
        (
        DEFAULT,
        'Pending',
        '$_POST[gn]', 
        '$_POST[cn]', 
        '$_POST[em]',
        '$_POST[adr]',
        '$_POST[gq]', 
        '$room',
        '$_POST[ad]',
        '$_POST[dd]',
        '$los',
        '$cost',
        '$remark',
        '$payment_received',
        '$payment_change'
        ) ";
        $res = $link->query($sqlQuery);
        ob_end_flush();

      // ---------- Save action to the Database
        date_default_timezone_set("Asia/Manila");
        $date = date("Y-m-d");
        $time = date("h:i:s a");
        $action = "New Reservation";
        $log = $_POST['gn']." (Guest) | Created a new reservation.";
        $sqlQuery = "INSERT INTO history VALUES (DEFAULT,'$date','$time','$action','$log')";
        $res = $link->query($sqlQuery);
?>