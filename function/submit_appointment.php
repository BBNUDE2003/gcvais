<?php
// Start the session
session_start();

// Include the database connection details
include '../function/db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '<div class="container mt-5 text-center">';
    echo '<div class="alert alert-warning" role="alert">';
    echo '<h4 class="alert-heading">Unauthorized Access!</h4>';
    echo '<p>You need to be logged in to save your details.</p>';
    echo '<a href="../php/login.php" class="btn btn-primary">Log In</a>';
    echo '</div>';
    echo '</div>';
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$registergenerateid = htmlspecialchars($_POST['registergenerateid']);
$client_name = htmlspecialchars($_POST['client_name']);
$address = htmlspecialchars($_POST['address']);
$cell_number = htmlspecialchars($_POST['cell_number']);
$email = htmlspecialchars($_POST['email']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);
$type_animal = htmlspecialchars($_POST['type_animal']);
$services = htmlspecialchars($_POST['services']);
$request = htmlspecialchars($_POST['request']);

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO appointments (client_id, client_name, address, cell_number, email, date, time, type_animal, services, request) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssssssss", $registergenerateid, $client_name, $address, $cell_number, $email, $date, $time, $type_animal, $services, $request);

// Execute the statement and check for success
if ($stmt->execute()) {
    // Appointment saved to database
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '<div class="container mt-5 text-center" style="margin-top: 20vh;">';
    echo '<div class="alert alert-success" role="alert">';
    echo '<h4 class="alert-heading">Details saved!</h4>';
    echo '<p>Your details have been saved successfully.</p>';
    echo '<a href="../php/apoint.php" class="btn btn-primary">Go to Appointment Page</a>';
    echo '</div>';
    echo '<div class="mt-4">';
    echo '<img src="../image/success.gif" alt="Success" style="width: 100%;">'; // Adjusted the width for visibility
    echo '</div>';
    echo '</div>';
    exit();
} else {
    // Error saving details
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
    echo '<div class="container mt-5 text-center">';
    echo '<div class="alert alert-danger" role="alert">';
    echo '<h4 class="alert-heading">Error!</h4>';
    echo '<p>' . htmlspecialchars($stmt->error) . '</p>';
    echo '</div>';
    echo '</div>';
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
