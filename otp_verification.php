<!-- otp_verification.php -->
<?php
// ... (existing code)

$email = $_GET['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp_entered = $_POST['otp'];
    // Retrieve stored OTP from the database
    $sql = "SELECT otp FROM `user_info` WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row && $otp_entered == $row['otp']) {
        // OTP validation successful, redirect to another page
        header('Location: index.php');
        exit();
    } else {
        $error_message = "Invalid OTP";
    }

    mysqli_stmt_close($stmt);
}

// ... (HTML form for OTP entry)
