
<?php
  if(isset($_GET['id']))
  {
    $name = $_GET['name'];
    $id = $_GET['id'];
    $pass = $_GET['pass'];
    $spl = $_GET['spl'];
    $age = $_GET['age'];
    $gender = $_GET['gender'];
    $spoken = $_GET['spoken'];
    $email = $_GET['email'];
    $phone = $_GET['phone'];
  }
  $servername="localhost";
  
  $username="root";
  $password="";
  $db="ip";
  $conn=mysqli_connect($servername,$username,$password,$db);
  $sql="SELECT appoi_id,dept, docid, userid, datee, timee, status,payment FROM appoint WHERE docid='$id'";
  $result=mysqli_query($conn,$sql);
  $appointments = [];
  if(mysqli_num_rows($result) > 0)
  {
    while($row=mysqli_fetch_assoc($result))
    {
        $appointments[] = $row;
    }
  }
?>

<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 100vh;
            }
            .container {
                display: flex;
                background: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;
                width: 800px;
                margin-bottom: 20px;
            }
            .details, .image-container {
                padding: 20px;
            }
            .details {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .profile {
                margin: 10px 0;
            }
            .profile span {
                font-weight: bold;
            }
            .image-container {
                display: flex;
                justify-content: center;
                align-items: center;
                background: #f0f0f0;
                width: 300px;
                height: 350px;
            }
            .details h1 {
                margin: 0 0 20px;
                text-align: center;
            }
            .image-container img {
                width: 500px;
            }
            .table-detail {
                width: 1100px;
                background: white;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                overflow: hidden;
                margin-top: 20px;
            }
            .table-detail table {
                width: 100%;
                border-collapse: collapse;
            }
            .table-detail th, .table-detail td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            .table-detail th {
                background-color: #f2f2f2;
            }
            .yes {
                background-color: green;
                color: white;
                font-weight: bold;
                border-radius: 5px;
                padding: 5px 10px;
                margin-top: 10px;
            }
            .no {
                background-color: red;
                color: white;
                font-weight: bold;
                border-radius: 5px;
                padding: 5px 10px;
                margin-top: 10px;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/themes/default.min.css"/>
    </head>
    <body>
        <div class="container">
            <div class="details">
                <h1>DOCTOR PROFILE</h1>
                <?php
                echo "<div class='profile'><span>Name:</span> $name</div>";
                echo "<div class='profile'><span>ID:</span> $id</div>";
                echo "<div class='profile'><span>Pass:</span> $pass</div>";
                echo "<div class='profile'><span>Specialist:</span> $spl</div>";
                echo "<div class='profile'><span>Age:</span> $age</div>";
                echo "<div class='profile'><span>Gender:</span> $gender</div>";
                echo "<div class='profile'><span>Spoken Language:</span> $spoken</div>";
                echo "<div class='profile'><span>Phone No:</span> $phone</div>";
                echo "<div class='profile'><span>Email:</span> $email</div>";
                ?>
            </div>
            <div class="image-container">
                <img src="images/docpro.jpg" alt="Doctor img">
            </div>
        </div>

        <div class="table-detail">
            <h2 style="text-align:center;">APPOINTMENTS</h2>
            <table>
                <thead>
                    <tr>
                        <th>Appointment_Id</th>
                        <th>Department</th>
                        <th>Doctor ID</th>
                        <th>User ID</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment_status</th>
                        <th>Accept</th>
                        <th>Reject</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $mail = '';
                    if (!empty($appointments)) {
                        foreach ($appointments as $appointment) {
                             $id=$appointment['userid'];
                           
                              $sql="select mail from patients where id='$id'";
                              $res=mysqli_query($conn,$sql);
                    
                              if($res && mysqli_num_rows($res) > 0)
                              {
                                $data=mysqli_fetch_assoc($res);
                                $mail = $data['mail'];
                              }
                
                              
                            echo "<tr>";
                            echo "<td>{$appointment['appoi_id']}</td>";
                            echo "<td>{$appointment['dept']}</td>";
                            echo "<td>{$appointment['docid']}</td>";
                            echo "<td>{$appointment['userid']}</td>";
                            echo "<td>{$appointment['datee']}</td>";
                            echo "<td>{$appointment['timee']}</td>";    
                            echo "<td>{$appointment['payment']}</td>";
                            echo "<td>
                                 <form method='post' action='update_appointment.php'>
                                <input type='hidden' name='appoi_id' value='{$appointment['appoi_id']}'>
                                <input type='hidden' name='action' value='accept'>
                                   <input type='submit' class='yes' value='Accept'>
            
                                 </form>
                            </td>";
                    echo "<td>
                            <form method='post' action='update_appointment.php'>
                                <input type='hidden' name='appoi_id' value='{$appointment['appoi_id']}'>
                                <input type='hidden' name='action' value='reject'>
                                 <input type='submit' class='no' value='Reject'>
                               
                            </form>
                        </td>";
                            echo "<td>{$appointment['status']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' style='text-align: center;'>No appointments found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
        <script>
            function accept()
            {
                alertify.set('notifier','position','top-center');
                alertify.success("LOGIN SUCESSFULL",2); 
            }
         window.onload=function()
         {
            const urlParams=new URLSearchParams(window.location.search);
            if(urlParams.get('status')=='success')
            {
                alertify.set('notifier','position','top-center');
                alertify.success("LOGIN SUCESSFULL",2);
                setTimeout(() => {
                    urlParams.delete('status');
                    const newurl=window.location.pathname +'?'+ urlParams.toString();
                    window.history.replaceState({},document.title,newurl);
                    
                }, 2000);
            }
            
         }
        </script>
    </body>
</html>
