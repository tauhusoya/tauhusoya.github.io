<?php
include 'session_start.php';

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
    <link rel="stylesheet" href="css/admin_appointment.css" />
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
                <a href="create.php" class="button">New Appointment</a>
                    <br><br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Bil</th>
                                <th>Name</th>
                                <th>IC Number</th>
                                <th>Phone Number</th>
                                <th>Doctor</th>
                                <th>Appointment Date</th>
                                <th>Time Slot</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            include 'connect.php';

                            $sql = "SELECT * FROM appointment";
                            $result = $conn->query($sql);

                            if ($result == false) {
                                die ("Invalid query: " . $conn->error);
                            }

                            while ($row = $result->fetch_assoc()) {
                                echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['ic']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['doctor']}</td>
                                    <td>{$row['appointment_date']}</td>
                                    <td>{$row['time_slot']}</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm' href='edit.php?id={$row['id']}'>Edit</a>
                                        <a class='btn btn-danger btn-sm' href='delete.php?id={$row['id']}' onclick='confirmDelete(event)'>Delete</a>
                                    </td>
                                </tr>
                                ";
                            }
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
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
