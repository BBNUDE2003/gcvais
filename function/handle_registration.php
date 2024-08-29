<?php
include '../function/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get all the form data, including the generated ID
    $generated_id = $_POST['registergenerateid'];
    $firstname = $_POST['registerFirstname'];
    $middlename = $_POST['registerMiddlename'];
    $lastname = $_POST['registerLastname'];
    $gender = $_POST['registerGender'];
    $dob = $_POST['registerDOB'];
    $age = $_POST['registerAge'];
    $contact = $_POST['registerContact'];
    $address = $_POST['registerAddress'];
    $email = $_POST['registerEmail'];
    $username = $_POST['registerUsername'];
    $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);

    // Check if email or username already exists
    $check_sql = "SELECT id FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<div class="invalid-message" style="color: red; font-weight: bold; text-align: center; margin-top: 20px; font-size: 50px;">Email or Username already exists. Please try another one.</div>';
        echo '<div class="redirect-message" style="text-align: center; margin-top: 10px; font-size: 20px;">Redirecting to the login page...</div>';
        echo '<script>setTimeout(function(){ window.location.href = "../index.php"; }, 2000);</script>';
        exit();
    }

    $stmt->close();

    // Insert new user with generated ID
    $sql = "INSERT INTO users (client_id, firstname, middlename, lastname, gender, dob, age, contact, address, email, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssssssssss", $generated_id, $firstname, $middlename, $lastname, $gender, $dob, $age, $contact, $address, $email, $username, $password);

    if ($stmt->execute()) {
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<div class="invalid-message" style="color: green; font-weight: bold; text-align: center; margin-top: 20px; font-size: 50px;">Registration successful. Please login.</div>';
        echo '<div class="redirect-message" style="text-align: center; margin-top: 10px; font-size: 20px;">Redirecting to the login page...</div>';
        echo '<script>setTimeout(function(){ window.location.href = "../index.php"; }, 2000);</script>';
    } else {
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<div class="error-message" style="color: red; font-weight: bold; text-align: center; margin-top: 20px; font-size: 50px;">Error: ' . $stmt->error . '</div>';
        echo '<div class="redirect-message" style="text-align: center; margin-top: 10px; font-size: 20px;">Redirecting to the login page...</div>';
        echo '<script>
            alert("Error: ' . $stmt->error . '");
            setTimeout(function() {
                window.location.href = "../index.php";
            }, 2000);
        </script>';
    }
    $stmt->close();
    $conn->close();
}
?>
