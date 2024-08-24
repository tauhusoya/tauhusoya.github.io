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
    <link rel="stylesheet" href="css/admin_overview.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <div class="sidebar-header">
            <h2>Panel <?php echo $role; ?></h2>
        </div>
        <a href="admin_overview.php"><i class="bx bx-stats"></i> Statistik</a>
        <a href="admin_appointment.php"><i class="bx bx-task"></i> Temu Janji</a>
        <a href="admin_patient.php"><i class="bx bxs-group"></i> Pesakit</a>
        <a href="admin_doctor.php"><i class="bx bx-health"></i> Doktor</a>
        <a href="admin_dashboard.php"><i class="bx bx-desktop"></i> Pentadbir</a>
        <a href="logout.php"><i class="bx bx-log-out"></i> Log Keluar</a>
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
                <h1>Selamat Datang, <?php echo $username; ?></h1>
                <p>Posisi: <?php echo $role; ?></p>
                <p>StafId: <?php echo $staff_id; ?></p>
            </div>
        </div>
        <div class="overview">
            <div class="overview-box">
                <h3><i class="bx bxs-group large-icon"></i> Pesakit</h3>
            </div>
            <div class="overview-box">
                <h3><i class="bx bx-health large-icon"></i> Doktor</h3>
            </div>
            <div class="overview-box">
                <h3><i class="bx bx-task large-icon"></i> Temu Janji</h3>
            </div>
        </div>
        <div class="overview-extend">
            <div class="overview-box-extend-1">
                <h3><i class="bx bx-line-chart large-icon"></i> Jumlah Pendaftar Bulan Ini</h3>
            </div>
            <div class="overview-box-extend-2">
                <h3><i class="bx bxs-doughnut-chart large-icon"></i> Jumlah Hasil</h3>
            </div>
        </div>
    </div>

    <script src="js/admin_overview.js"></script>
</body>
</html>
