<?php


$servername = "localhost";
$username = "root";
$password = "";
$db = "ip";

$conn = new mysqli($servername, $username, $password, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, pass, name, bg, dob, mail, gender, mob, address,file FROM patients";


$result = $conn->query($sql);

$patients = array();
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }
}


$conn->close();


header('Content-Type: application/json');
echo json_encode($patients);
?>
