<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $qno= $_POST['qno'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];


    // Replace the connection details with your MySQL credentials
    $conn = new mysqli('localhost', 'root', 'root', 'lms');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create a table for the quiz if not exists
    $createTableQuery = "
        CREATE TABLE IF NOT EXISTS quiz (
            id INT AUTO_INCREMENT PRIMARY KEY,
            qno INT,
            question TEXT,
            option1 TEXT,
            option2 TEXT,
            option3 TEXT,
            option4 TEXT,
            answer TEXT
        )
    ";

    if ($conn->query($createTableQuery) === FALSE) {
        echo "Error creating table: " . $conn->error;
    }

    // Insert the question into the database
    $insertQuery = "
        INSERT INTO quiz (qno, question, option1, option2, option3, option4, answer)
        VALUES ('$qno', '$question', '$option1', '$option2', '$option3', '$option4', '$answer')
    ";

    if ($conn->query($insertQuery) === FALSE) {
        echo "Error inserting question: " . $conn->error;
    } else {
        echo "<p>Question submitted successfully!</p>";
    }

    // Close the connection
    $conn->close();
}
?>
