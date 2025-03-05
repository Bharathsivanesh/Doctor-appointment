<?php
$servername="localhost";
  
$username="root";
$password="";
$db="ip";
$conn=mysqli_connect($servername,$username,$password,$db);


    $appointId = $_POST['appoi_id'];
    $msg = "Payment from Appointment_ID: $appointId";
    $upiID = 'bharathsivanesh@oksbi';
   $payeeName = 'Bharath sivanesh';
    $amount = '1';
    

$upiUrl = "upi://pay?pa=$upiID&pn=$payeeName&am=$amount&tn=$msg";

$qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($upiUrl);

$sql="update appoint set payment='SUCCESS' where appoi_id=$appointId";
mysqli_query($conn,$sql);


   
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UPI QR Code Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background:url(images/qr.png);
        }
        .container {
            background: rgba(255, 255, 255, 0.8); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 500px;
        }
        #qrcode img {
            border: 5px solid #f4f4f9;
            border-radius: 10px;
            width: 300px;
        }
        .description {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
            font-weight: bold;
            color:black;
        }
        .btn {
            background-color: green;
            padding: 10px 10px;
            border-radius: 5px;
            margin-top: 20px;
            color: white;
        }
        a{
            background-color: red;
            padding: 10px 40px;
            border-radius: 5px;
            margin-top: 20px;
            color: white;
            text-decoration: none;
        }
       
       

    </style>
</head>
<body>
    <div class="container">
        <div id="qrcode">
            <img src="<?php echo $qrCodeUrl; ?>" alt="UPI QR Code">
        </div>
        <div class="description">
            <p>Quickly and securely complete your payment by scanning <br>this QR code with your UPI app.</p>
        </div>
        <form action="qr.php" method="post">
            <input type="hidden" name="appoi_id" value="<?php echo $appointId; ?>">
            <button class="btn" type="submit" onclick="func()">Click To Proceed</button>
            <a href="patlogin.html">Back</a>
        </form>
    </div>
    <script>
        function func()
        {
            alert ("PAYEMNT SUCCEFULLY UPDATED");
        }
    </script>

</body>
</html>
<?php

?>
