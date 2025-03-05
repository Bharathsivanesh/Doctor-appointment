    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $name = $_GET['name'];
        $bg = $_GET['bg'];
        $dob = $_GET['dob'];
        $mail = $_GET['mail'];
        $gender = $_GET['gender'];
        $mob = $_GET['mob'];
        $address = $_GET['address'];
        $file = $_GET['file'];
        $servername="localhost";

$username="root";
$password="";
$db="ip";
$conn=mysqli_connect($servername,$username,$password,$db);

$sql="SELECT * FROM appoint WHERE userid='$id'";
$result = $conn->query($sql);
   if(mysqli_num_rows($result)>0)
   {
    $appointments = [];
    while($row=mysqli_fetch_assoc($result))
    {
        $appointments[]=$row;
    }
   }


   $sql_doctors = "SELECT id, name, spl FROM doctor";
   $result_doctors = $conn->query($sql_doctors);
   if (mysqli_num_rows($result_doctors) > 0) {
       $doctors = [];
       while ($row = mysqli_fetch_assoc($result_doctors)) {
           $doctors[] = $row;
       }
   }
   
   mysqli_close($conn);


    
    }
    ?>
    <html>
        <head>
            <title>USER PROFILE</title>
            <link rel="stylesheet" href="userpage.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
        </head>
        <body>
        <div class="container">
            <div class="profile-container">
            <div class="column">
            <h2 class="user">USER PROFILE</h2>
            <div class="profile">
              
                <?php
         echo "<img src='uploads/$file' alt='user' width='150px' height='150px'>";    
         echo "<div class='prof'><span>ID:</span> $id</div><br>";
         echo "<div class='prof'><span>Name:</span> $name</div><br>";
         echo "<div class='prof'><span>Blood Group:</span> $bg</div><br>";
         echo "<div class='prof'><span>Date of Birth:</span> $dob</div><br>";
         echo "<div class='prof'><span>Email:</span> $mail</div><br>";
         echo "<div class='prof'><span>Gender:</span> $gender</div><br>";
         echo "<div class='prof'><span>Mobile No:</span> $mob</div><br>";
         echo "<div class='prof'><span>Address:</span> $address</div>";
          ?>
            </div>
            </div>
            <div class="column">
            <h2>BOOK APPOINTMENT</h2>
            <div class="appoint">
                <form id="appointmentForm">
                    <input type="hidden" name="userid" value="<?php echo $id ?>">
                   
                    <label>Select Department</label>
                        <select name="dept" id="dept" required>
                            <option value="">Select Department</option>
                            <?php
                          
                            $conn = mysqli_connect($servername, $username, $password, $db);
                            $sql = "SELECT DISTINCT spl FROM doctor";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $department = $row['spl'];
                                    echo "<option value='$department'>$department</option>";
                                }
                            }

                            mysqli_close($conn);
                            ?>
                        </select>
                    <br>
                    <label>Slect Doctor ID</label>
                    <select name="docid" id="docid" required>
                            <option value="">Select DoctorId</option>
                            <?php
                           $conn = mysqli_connect($servername, $username, $password, $db);
                            $sql = "SELECT DISTINCT id FROM doctor";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['id'];
                                    echo "<option value='$id'>$id</option>";
                                }
                            }

                            mysqli_close($conn);
                            ?>
                        </select>
                    <br>
                    <label>Date</label>
                    <input type="date" name="datee" required>
                    <br>
                    <label>Time</label>
                    <input type="time" name="timee" required>
                    <br>
                    <input type="submit" value="BOOK">

                </form>
            </div>
        </div>
        </div>
      
        <h2>APPOINTMENT STATUS</h2>
       
        
    <div class="appointment-status">
        <table>
            <thead>
            <tr>
                <th>Appoint_Id</th>
                <th>Dept</th>
                <th>docId</th>
                <th>UserId</th>
                <th>Date</th>
                <th>Time</th>
                <th>payment</th>
                <th>payment_status</th>
                <th>Appointment_Status</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($appointments)) {
                foreach ($appointments as $appointment) {
                    echo "<tr>";
                    echo "<td>{$appointment['appoi_id']}</td>";
                    echo "<td>{$appointment['dept']}</td>";
                    echo "<td>{$appointment['docid']}</td>";
                    echo "<td>{$appointment['userid']}</td>";
                    echo "<td>{$appointment['datee']}</td>";
                    echo "<td>{$appointment['timee']}</td>";
                    echo "<td>
                    <form method='post' action='qr.php'>
                      <input type='hidden' name='appoi_id' value='{$appointment['appoi_id']}'>
                      <input type='submit' value='PAY' class='paybtn'>
                    </form>
                   </td>";
                    echo "<td>{$appointment['payment']}</td>";
                    echo "<td>{$appointment['status']}</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No appointments found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <h2>DOCTOR DETAILS</h2>
    <div class="doctor-details">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Specialization</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($doctors)) {
                foreach ($doctors as $doctor) {
                    echo "<tr>";
                    echo "<td>{$doctor['id']}</td>";
                    echo "<td>{$doctor['name']}</td>";
                    echo "<td>{$doctor['spl']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No doctors found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

        </div>
        <script>
       $(document).ready(function()
    {
        $('#appointmentForm').submit(function(event)
    {
        event.preventDefault();
        $.ajax({
            url:'appoint.php',
            type:'POST',
            data:$(this).serialize(),
            success:function(response)
            {
                alert(response);
                location.reload();
            },
            error:function(error)
            {
                alert('Error in submitting form');
            }
        });
    });
    });
    </script>
   
        </body>
    </html>
