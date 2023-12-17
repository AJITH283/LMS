<?php

// Create connection
$conn = mysqli_connect("localhost", "root", "root", "lms");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize message variable
$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if required fields are set and not empty
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['address'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        // Use prepared statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO `user_info`(`name`, `email`, `password`, `address`) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $address);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            
             echo"<P>Registration successfull. Redirecting to home page...</P>";
            // Redirect to index.php after a delay
            header("refresh:3;url=index.html");
            exit();
        } else {
            $message = "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $message = "Please fill in all the required fields.";
    }
}

// Close the connection
mysqli_close($conn);

echo $message;
?>
