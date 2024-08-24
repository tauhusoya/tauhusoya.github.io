<?php
include "connect.php";
session_start(); // Make sure to start the session

// Fetch existing data for the appointment
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM appointment WHERE id=$id");
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect updated data from form
    $name = $_POST['name'];
    $ic = $_POST['ic'];
    $phone = $_POST['phone'];
    $doctor = $_POST['doctor'];
    $date = $_POST['appointment_date'];
    $time = $_POST['time_slot'];

    // Perform the update query
    $conn->query("UPDATE appointment SET name='$name', ic='$ic', phone='$phone', doctor='$doctor', appointment_date='$date', time_slot='$time' WHERE id=$id");

    // Redirect to prevent form resubmission and display the updated list
    header("Location: admin_appointment.php");
    exit();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Unknown';
$staff_id = isset($_SESSION['staff_id']) ? $_SESSION['staff_id'] : 'Unknown';
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
            <h2><?php echo htmlspecialchars($role); ?> Panel</h2>
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
                <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
                <p>Position : <?php echo htmlspecialchars($role); ?></p>
                <p>Staff Id : <?php echo htmlspecialchars($staff_id); ?></p>
            </div>
        </div>
        <div class="appointment-dashboard">
            <h1 class="dashboard-title">Appointment</h1>
            <div class="user-information">
                <div class="container">
                    <h2>Edit Appointment</h2>
                    <form action="edit.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                        <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user['name']); ?>">
                        <input type="text" name="ic" placeholder="IC Number" value="<?php echo htmlspecialchars($user['ic']); ?>">
                        <input type="text" name="phone" placeholder="Phone Number" value="<?php echo htmlspecialchars($user['phone']); ?>">
                        <label for="doctor">Select Doctor</label>
                        <select name="doctor">
                            <option disabled <?php if(empty($user['doctor'])) echo 'selected'; ?>>Please select</option>
                            <option value="Dr. Nik Ariff" <?php if($user['doctor'] == 'Dr. Nik Ariff') echo 'selected'; ?>>Dr. Nik Ariff</option>
                            <option value="Dr. Hani" <?php if($user['doctor'] == 'Dr. Hani') echo 'selected'; ?>>Dr. Hani</option>
                        </select>
                        <label for="date">Select Date</label>
                        <input type="date" name="appointment_date" placeholder="Appointment Date" value="<?php echo htmlspecialchars($user['appointment_date']); ?>">
                        <label for="time">Select Time</label>
                        <select name="time_slot">
                            <option disabled <?php if(empty($user['time_slot'])) echo 'selected'; ?>>Please select</option>
                            <option value="9.00 AM" <?php if($user['time_slot'] == '9.00 AM') echo 'selected'; ?>>9.00 AM</option>
                            <option value="10.00 AM" <?php if($user['time_slot'] == '10.00 AM') echo 'selected'; ?>>10.00 AM</option>
                            <option value="11.00 AM" <?php if($user['time_slot'] == '11.00 AM') echo 'selected'; ?>>11.00 AM</option>
                            <option value="2.00 PM" <?php if($user['time_slot'] == '2.00 PM') echo 'selected'; ?>>2.00 PM</option>
                            <option value="3.00 PM" <?php if($user['time_slot'] == '3.00 PM') echo 'selected'; ?>>3.00 PM</option>
                            <option value="4.00 PM" <?php if($user['time_slot'] == '4.00 PM') echo 'selected'; ?>>4.00 PM</option>
                        </select>
                        <button type="submit" name="submit">Update Appointment</button>
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