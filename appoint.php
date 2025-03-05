<?php
$servername="localhost";

$username="root";
$password="";
$db="ip";
$conn=mysqli_connect($servername,$username,$password,$db);
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $dept=$_POST['dept'];
    $docid=$_POST['docid'];
    $userid=$_POST['userid'];
    $datee=$_POST['datee'];
    $timee=$_POST['timee'];
    $status="PENDING";
    $sql = "INSERT INTO appoint (dept, docid, userid, datee, timee, status) VALUES ('$dept', '$docid', '$userid', '$datee', '$timee', '$status')";

    if($conn->query($sql))
    {
        echo "APPOINTMENT REGISTERED";
    }
    else{
        echo "VALUES INVALID TO INSERT";
    }
}

?>