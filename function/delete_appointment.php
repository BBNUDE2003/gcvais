<?php
session_start();
require_once '../function/db_connect.php';

if (!isset($_SESSION['client_id']) || !isset($_GET['appointment_id'])) {
    die("Invalid access.");
}

$appointment_id = $_GET['appointment_id'];
$client_id = $_SESSION['client_id'];

// Delete appointment
$sql = "DELETE FROM appointments WHERE appointment_id = ? AND client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $appointment_id, $client_id);
$stmt->execute();

header("Location: ../php/profile.php");
exit();
?>
