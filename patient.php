
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
   
   $fileexe=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION); //get extension
   $filepath=time().'.'.$fileexe;  //add extension with unique time
    move_uploaded_file($_FILES['image']['tmp_name'],"uploads/".$filepath); //moving to the upload folder
    $id=$_POST['id'];
    $pass=$_POST['pass'];
    $name=$_POST['name'];
    $bg=$_POST['bg'];
    $dob=$_POST['dob'];
    $mail=$_POST['mail'];
    $gender=$_POST['gender'];
    $mob=$_POST['mob'];
    $address=$_POST['address'];
    


    $sql="insert into patients values('$id','$pass','$name','$bg','$dob','$mail','$gender','$mob','$address','$filepath')";
    try{

    if($conn->query($sql))
    {
        
      header("Location:patient.html?status=success");
      exit();

    }
}
catch(mysqli_sql_exception $e)
{

   
        if($e->getcode()==1062)
        {
             echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>PATIENT LOGIN</title><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/><script src='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js'></script></head><body>";
            echo "<script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('ID is Already Exists!');
             setTimeout(function() {
                    window.location.href = 'patient.html';
                }, 1000); 
           
        </script>";
   
      
       
     }
        else{
            echo "erro in query";
        }
    
}
}

?>