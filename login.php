<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "root", "lms");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$pass = $_POST['pass'];

// Query the database using a prepared statement
$sql = "SELECT * FROM `user_info` WHERE name = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $name);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    // Fetch the user data
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($pass, $row['password'])) {
        // Login successful, redirect to another page
        header('Location: index.html');
        exit();
    } else {
        // Incorrect username or password
        $error_message = "Invalid username or password";
    }
} else {
    // SQL query failed
    $error_message = "Error: " . mysqli_error($conn);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);

echo $error_message;
?>