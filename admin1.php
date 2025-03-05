
<?php
$servername="localhost";
$username="root";
$password="";
$db="ip";
$conn=mysqli_connect($servername,$username,$password,$db);
if($conn->connect_error)
{
    die("Error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    try{

    $name=$_POST['name'];
    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $spl=$_POST['spl'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $spoken_lang=$_POST['lang'];
    $emaill=$_POST['gmail'];
    $phone_no=$_POST['no'];
    $sql="insert into doctor values('$name','$id','$pass','$spl','$age','$gender','$spoken_lang','$emaill','$phone_no')";
    if($conn->query($sql)==TRUE)
    {
        header("Location:admin1.html?status=success");
    }
}

    catch(Exception $e)
    {
        echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>PATIENT LOGIN</title><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/><script src='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js'></script></head><body>";
            echo "<script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('ID is Already Exists!');
           
        </script>";
   
       header("Location:admin1.html?status=fail");
    }
  
}

?>