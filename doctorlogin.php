<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ip";
$conn = mysqli_connect($servername, $username, $password, $db);

if ($_SERVER['REQUEST_METHOD']=='POST') {        
    $id = $_POST['id'];
    $pass = $_POST['pass'];
    $sql = "select * from doctor where id='$id' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    $pat=mysqli_fetch_assoc($result);
   
    if ($pat) {
        header("Location:doctorpage.php?id=".$pat['id']."&name=".$pat['name']."&id=".$pat['id']."&pass=".$pat['pass']."&spl=".$pat['spl']."&age=".$pat['age']."&gender=".$pat['gender']."&spoken=".$pat['spoken_lang']."&email=".$pat['email']."&phone=".$pat['phone_no']."&status=success");
        exit;
    } 
    else{
        header("Location:doclogin.html?status=fail");
    }

}

    
?>
 