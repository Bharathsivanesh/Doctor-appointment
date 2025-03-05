<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ip";
$connection = mysqli_connect($servername, $username, $password, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['pass'];

 
    $query = "SELECT * FROM patients WHERE id='$id' AND pass='$password'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    // Output HTML with AlertifyJS
    echo "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>PATIENT LOGIN</title><link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/><script src='https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js'></script></head><body>";

    if ($user) {
        echo "<script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.success('Login Successful!');
            setTimeout(function() {
                window.location.href ='userpage.php?id=".$user['id']."&name=".$user['name']."&bg=".$user['bg']."&dob=".$user['dob']."&mail=".$user['mail']."&gender=".$user['gender']."&mob=".$user['mob']."&address=".$user['address']."&file=".$user['file']."';
            }, 1000);
        </script>";
    } else {
        echo "<script>
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('Invalid username or password');
            setTimeout(function() {
                window.location.href = 'patlogin.html';
            }, 2000);
        </script>";
    }

    echo "</body></html>";

    
}
mysqli_close($connection);
?>

