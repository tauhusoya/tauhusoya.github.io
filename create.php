<?php
include "connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $ic = $_POST['ic'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $date = $_POST['appointment_date'];
    $time = $_POST['time_slot'];

    if ($conn->query("INSERT INTO appointment (name, ic, phone, doctor, appointment_date, time_slot) VALUES ('$name', '$ic', '$phone', '$doctor', '$date', '$time')") === TRUE) {
        echo "<script>alert('Data has been inserted successfully'); window.location.href = 'admin_appointment.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href = 'admin_appointment.php';</script>";
    }
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = 'Guest';
}

if (isset($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];
} else {
    $role = 'Unknown';
}

if (isset($_SESSION['staff_id'])) {
    $staff_id = $_SESSION['staff_id'];
} else {
    $staff_id = 'Unknown';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | Primer Cherang</title>
    <link rel="stylesheet" href="css/create.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <div class="sidebar-header">
            <h2><?php echo $role; ?> Panel</h2>
        </div>
        <a href="admin_overview.php"><i class="bx bx-stats"></i> Statistic</a>
        <a href="admin_appointment.php"><i class="bx bx-task"></i> Appointment</a>
        <a href="admin_patient.php"><i class="bx bxs-group"></i> Patient</a>
        <a href="admin_doctor.php"><i class="bx bx-health"></i> Staff</a>
        <a href="logout.php"><i class="bx bx-log-out"></i> Log out</a>
    </div>

    <div id="main" class="content">
        <div class="header">
            <div class="header-sidebar">
                <span id="menuButton" class="openbtn" onclick="toggleNav()">
                    <i class="bx bx-menu large-icon"></i>
                </span>
            </div>
            <div class="header-logo">
                <img src="assets/logoklinik.png" />
            </div>
            <div class="header-title">
                <h1>Welcome, <?php echo $username; ?></h1>
                <p>Position : <?php echo $role; ?></p>
                <p>Staff Id : <?php echo $staff_id; ?></p>
            </div>
        </div>
        <div class="appointment-dashboard">
            <h1 class="dashboard-title">Appointment</h1>
            <div class="user-information">
                <div class="container">
                    <h2>Add New Appointment</h2>
                    <form action="create.php" method="post">
                        <input type="text" name="name" placeholder="Name">
                        <input type="text" name="ic" placeholder="IC Number">
                        <input type="text" name="phone" placeholder="Phone Number">
                        <label for="doctor">Select Doctor</label>
                        <select name="doctor">
                            <option disabled selected>Please select</option>
                            <option value="Dr. Nik Ariff">Dr. Nik Ariff</option>
                            <option value="Dr. Hani">Dr. Hani</option>
                        </select>
                        <label for="date">Select Date</label>
                        <input type="date" name="appointment_date" placeholder="Appointment Date">
                        <label for="time">Select Time</label>
                        <select name="time_slot">
                            <option disabled selected>Please select</option>
                            <option value="9.00 AM">9.00 AM</option>
                            <option value="9.00 AM">10.00 AM</option>
                            <option value="9.00 AM">11.00 AM</option>
                            <option value="9.00 AM">2.00 PM</option>
                            <option value="9.00 AM">3.00 PM</option>
                            <option value="9.00 AM">4.00 PM</option>
                        </select>
                        <button type="submit" name="submit">Add Appointment</button>
                        <button type="button" name="cancel" class="cancel-btn" onclick="history.back();">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/admin_appointment.js"></script>
    <script>
        function confirmDelete(event) {
            if (!confirm('Are you sure you want to delete this appointment?')) {
                event.preventDefault(); // Prevent the default action if not confirmed
            }
        }
</script>

</body>
</html>
