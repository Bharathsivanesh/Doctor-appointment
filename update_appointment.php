<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ip";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $appoi_id =  $_POST["appoi_id"];
    $action =  $_POST["action"];
    $status = ($action == "accept") ? "ACCEPTED" : "REJECTED";


    $sql = "UPDATE appoint SET status = '$status' WHERE appoi_id = '$appoi_id'";
    if (mysqli_query($conn, $sql)) {
          $sql = "SELECT p.mail
            FROM appoint a 
            JOIN patients p ON a.userid = p.id 
            WHERE a.appoi_id = '$appoi_id'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $appointment = mysqli_fetch_assoc($result);

            $to = $appointment['mail'];
           
            if($action=="accept")
            {
                echo "<script>";
                echo "window.location.href='mailto:$to?subject=Appointment%20ACCEPTED&body=Thanks for Your Visiting us Royal care '";
                echo "</script>";
                echo "sucess";
            }
            else{
                echo "<script>";
                echo "window.location.href='mailto:$to?subject=Appointment%20REJECTED&body=  Thanks for Your Visiting us Royal Care'";
                echo "</script>";
            }
            
            }
       
    mysqli_close($conn);
}
}

?>
