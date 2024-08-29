<?php
session_start();
include '../function/db_connect.php'; // Include your database connection file

// Check if the user is logged in and their email is stored in the session
if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];

    // Prepare the SQL query to fetch the generated_id
    $sql = "SELECT client_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the email parameter and execute the query
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($generated_id);
    
    // Fetch the result
    if ($stmt->fetch()) {
        // Return the generated_id as a response
        echo $generated_id;
    } else {
        // In case no user is found, return an appropriate message or empty string
        echo "No ID found";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the user is not logged in, you can return an error or handle it accordingly
    echo "User not logged in.";
}
?>
