<?php
// Database connection
$host = 'localhost'; 
$db = 'veterans_db'; 
$user = 'root'; 
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

// Get slot_time from the POST request
$slot_time = isset($_POST['slot_time']) ? $_POST['slot_time'] : '';

if ($slot_time) {
    // Update the time slot status to 'booked'
    $query = "UPDATE time_slots SET status = 'booked' WHERE slot_time = :slot_time";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['slot_time' => $slot_time]);

    echo 'Time slot updated to booked.';
} else {
    echo 'Invalid slot time.';
}
?>
