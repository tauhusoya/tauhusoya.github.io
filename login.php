<?php 
session_start();
include('connect.php');

$error_message = ''; // Initialize the error message variable

if(isset($_POST['submit']))
{
    $sql = "SELECT * FROM users WHERE username='" . mysqli_real_escape_string($conn, $_POST['username']) . "' AND password='" . mysqli_real_escape_string($conn, $_POST['password']) . "'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    if(!empty($data))
    {
        $_SESSION['user_role'] = $data['role'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['staff_id'] = $data['staff_id'];

        header('Location: dashboard.php');
        exit;
    }
    else
    {
        $error_message = 'Invalid username or password. Please try again.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Primer Cherang</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-logo">
                <img src="assets/logoklinik.png" alt="Clinic Logo">
            </div>
            <div class="header-title">
                <h1>KLINIK PRIMER CHERANG BANDAR SAUJANA PUTRA</h1>
            </div>
        </div>
        <div class="content">
            <div class="content-left">
                <div class="content-left-form">
                    <h1>Log In</h1>
                    <p>Welcome to Admin Portal PCCBSJ</p>
                    <?php if(!empty($error_message)): ?>
                        <div class="error-message">
                        <p><?php echo $error_message; ?></p>
                        </div>
                    <?php endif; ?>
                    <form id="loginForm" method="post" action="login.php" name="loginForm">
                        <input type="text" name="username" placeholder="User Name" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="submit">Log in</button>
                    </form>                  
                </div>
            </div>
            <div class="content-right">
                <img src="assets/logoklinik.png" alt="Clinic Logo">
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2024 Klinik Primer Cherang Bandar Saujana Putra</p>
        </div>
    </div>
</body>
</html>
