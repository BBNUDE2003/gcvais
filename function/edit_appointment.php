<?php
session_start();
require_once '../function/db_connect.php';

if (!isset($_SESSION['client_id']) || !isset($_GET['appointment_id'])) {
    die("Invalid access.");
}

$appointment_id = $_GET['appointment_id'];  // Use the correct query parameter
$client_id = $_SESSION['client_id'];

// Fetch the existing appointment details
$sql = "SELECT * FROM appointments WHERE appointment_id = ? AND client_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $appointment_id, $client_id);
$stmt->execute();
$result = $stmt->get_result();
$appointment = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update appointment details
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type_animal = $_POST['type_animal'];
    $services = $_POST['services'];
    $request = $_POST['request'];

    $update_sql = "UPDATE appointments SET date = ?, time = ?, type_animal = ?, services = ?, request = ? WHERE appointment_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $date, $time, $type_animal, $services, $request, $appointment_id);
    $update_stmt->execute();

    header("Location: ../php/profile.php");
    exit();
}

// Close the connection
$stmt->close();
$conn->close();
?>
<style>
/* Form container styling */
body {
    padding: 0;
    margin: 0;
    background-image: url('../image/citizine.png'); /* Update image path as necessary */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

.appointment-form {
    max-width: 600px; /* Maximum width for larger screens */
    margin: 0 auto; /* Center the form */
    padding: 20px; /* Add padding inside the form */
    background-color: #f9f9f9; /* Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    box-sizing: border-box; /* Include padding in width */
}

/* Label styling */
.appointment-form label {
    display: block; /* Block display for labels */
    margin-bottom: 8px; /* Space below labels */
    font-weight: lighter; /* Bold font for labels */
    font-size: 20px;
}

/* Input and textarea styling */
.form-input, .form-textarea {
    width: 100%; /* Full width of container */
    padding: 10px; /* Space inside inputs */
    margin-bottom: 15px; /* Space between fields */
    border: 1px solid #ddd; /* Border around inputs */
    border-radius: 4px; /* Rounded corners */
    box-sizing: border-box; /* Include padding in width */
}
select{
    width: 100%; /* Full width of container */
    padding: 10px; /* Space inside inputs */
    margin-bottom: 15px; /* Space between fields */
    border: 1px solid #ddd; /* Border around inputs */
    border-radius: 4px; /* Rounded corners */
    box-sizing: border-box; /* Include padding in width */
}

/* Textarea specific styling */
.form-textarea {
    height: 100px; /* Set a fixed height for textarea */
    resize: vertical; /* Allow vertical resizing only */
}

/* Submit button styling */
.form-submit {
    background-color: #038a15; /* Green background */
    color: #fff; /* White text */
    border: none; /* Remove default border */
    padding: 10px 20px; /* Padding inside button */
    border-radius: 4px; /* Rounded corners */
    font-size: 16px; /* Larger font size */
    font-weight: lighter; /* Bold text */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s ease; /* Smooth color transition */
}

.form-submit:hover {
    background-color: #218838; /* Darker green on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .appointment-form {
        margin-top: 20%;
        padding: 15px; /* Less padding on smaller screens */
        margin: 120px; /* Add margin on smaller screens */
        max-width: 600px; /* Maximum width for larger screens */
    }
}

@media (max-width: 480px) {
    .appointment-form {
        padding: 10px; /* Less padding on very small screens */
        margin: 5px; /* Reduce margin on very small screens */
        width: 100%;
        margin-top: 20%;
    }

    .form-textarea {
        height: 80px; /* Adjust height of textarea for small screens */
    }

    .form-submit {
        padding: 8px 16px; /* Adjust padding of submit button */
        font-size: 14px; /* Smaller font size for submit button */
    }
}

</style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<form method="post" action="" class="appointment-form">
    <center style="font-size: 30px; font-weight: lighter;">Update Appointment</center>
    <hr>
<label for="client_id">Client ID</label>
<input type="text" id="client_id" name="client_id" value="<?php echo htmlspecialchars($appointment['client_id']); ?>" class="form-input" readonly style="width: 30%;">

<label for="client_id">Client Name</label>
<input type="text" id="client_id" name="client_id" value="<?php echo htmlspecialchars($appointment['client_name']); ?>" class="form-input" readonly style="width: 30%;">
    <label for="date">Date:</label>
    <input type="date" name="date" value="<?php echo htmlspecialchars($appointment['date']); ?>" class="form-input" required>
    <?php
                    // Database connection settings
                    $host = 'localhost';
                    $db = 'veterans_db';
                    $user = 'root';
                    $pass = '';

                    // Create a new PDO instance
                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Prepare and execute the query
                        $stmt = $pdo->prepare("SELECT slot_time, label, status FROM time_slots");
                        $stmt->execute();

                        // Fetch all time slots
                        $time_slots = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo 'Connection failed: ' . $e->getMessage();
                    }
                    ?>
                    <!-- Time Slot Selection -->
                    <label for="time"><i class="fas fa-clock"></i> <strong>Time Slot</strong></label>
                    <select id="time" name="time" required>
                        <option value="" disabled selected>Please select a time slot</option>
                        <?php
                        foreach ($time_slots as $slot) {
                            $formatted_time = date('h:i A', strtotime($slot['slot_time']));
                            $label = htmlspecialchars($slot['label']); 
                            $status = htmlspecialchars($slot['status']); 
                            echo "<option value=\"{$slot['slot_time']}\" data-status=\"{$status}\">{$formatted_time} - {$label} ({$status})</option>";
                        }
                        ?>
                    </select>
                    <label for="type_animal"><i class="fas fa-paw"></i> <strong>Animal Type</strong></label>
                    <select id="type_animal" name="type_animal" required>
                        <option value="" disabled selected>Please select the type of animal</option>
                        <optgroup label="Mammals">
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                            <option value="rabbit">Rabbit</option>
                            <option value="hamster">Hamster</option>
                        </optgroup>
                        <optgroup label="Birds">
                            <option value="parrot">Parrot</option>
                            <option value="canary">Canary</option>
                        </optgroup>
                        <optgroup label="Fish">
                            <option value="goldfish">Goldfish</option>
                            <option value="betta">Betta Fish</option>
                        </optgroup>
                    </select>
                    <!-- services -->
                    <?php
                    try {
                        $stmt = $pdo->prepare("SELECT ServiceID, ServiceName FROM services ");
                        $stmt->execute();
                        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo 'Connection failed: ' . $e->getMessage();
                    }
                    ?>
                    <!-- services -->
    <label for="services"><i class="fas fa-comment"></i> <strong>Services</strong></label>
                    <select name="services" id="services" required>
                        <option value="" disabled selected>Select a service</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo htmlspecialchars($service['ServiceID']); ?>">
                                <?php echo htmlspecialchars($service['ServiceName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
    <label for="request">Request:</label>
    <textarea name="request" class="form-textarea" required><?php echo htmlspecialchars($appointment['request']); ?></textarea>

    <input type="submit" value="Update Appointment" class="form-submit">
</form>
