<?php
include("session_start.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php
        $role = $_SESSION["user_role"];
    ?>

    <?php
        if($role == 'admin') {
            include ('admin_overview.php');
        }
    ?>

    <?php
        if($role == 'doctor') {
            include ('doctor_overview.php');
        }
    ?>
					
</body>
</html>