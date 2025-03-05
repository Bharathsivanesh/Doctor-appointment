<?php


$servername = "localhost";
$username = "root";
$password = "";
$db = "ip";

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT dept,docid,userid,datee,timee,status  FROM appoint";


$result = $conn->query($sql);

$appointments = array();
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($appointments);
?>
