<?php
session_start();
require_once '../function/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Use a prepared statement to prevent SQL injection
    $sql = "SELECT id, username, client_id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $client_id, $hashed_password);
        $stmt->fetch();
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Store user id, username, and client_id in session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['client_id'] = $client_id;
            
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
            echo '<div class="alert alert-success text-center mt-5" role="alert">';
            echo '<h4 class="alert-heading">Login Successful!</h4>';
            echo '<p>Redirecting to the Appointment page...</p>';
            echo '</div>';
            header("refresh:2;url=../php/apoint.php");
        } else {
            echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
            echo '<div class="alert alert-danger text-center mt-5" role="alert">';
            echo '<h4 class="alert-heading">Invalid Password</h4>';
            echo '<p>Redirecting to the login page...</p>';
            echo '</div>';
            header("refresh:2;url=../index.php");
        }
    } else {
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<div class="alert alert-danger text-center mt-5" role="alert">';
        echo '<h4 class="alert-heading">No Account Found</h4>';
        echo '<p>Redirecting to the login page...</p>';
        echo '</div>';
        header("refresh:2;url=../index.php");
    }

    $stmt->close();
    $conn->close();
}
?>
