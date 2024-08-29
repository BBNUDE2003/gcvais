<?php
// Start the session
session_start();

// Include database connection
include '../function/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Prepare the SQL update statement
    $sql = "UPDATE users SET firstname=?, middlename=?, lastname=?, gender=?, dob=?, contact=?, address=?, email=? WHERE id=?";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $firstname, $middlename, $lastname, $gender, $dob, $contact, $address, $email, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the profile page
        header("Location: profile.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>