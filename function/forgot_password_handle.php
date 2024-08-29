<?php
// Include your database connection file
include '../php/db_connect.php'; 

// Get email from POST request
if (isset($_POST['forgotPasswordEmail'])) {
    $email = $_POST['forgotPasswordEmail'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "No account associated with this email";
        exit();
    }

    // Generate a unique reset token
    $reset_token = bin2hex(random_bytes(32));
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Set expiration time for the token (e.g., 1 hour from now)
    $expiry_date = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Store the reset token in the database
    $stmt = $conn->prepare("INSERT INTO password_resets (id, email, reset_token, expDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $email, $reset_token, $expiry_date);
    $stmt->execute();
    $stmt->close();

    // Send the password reset email
    $reset_link = "http://yourwebsite.com/reset_password.php?token=$reset_token";
    $subject = "Password Reset Request";
    $message = "Please click the following link to reset your password: $reset_link";
    $headers = "From: no-reply@yourwebsite.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "Password reset link has been sent to your email address.";
    } else {
        echo "Failed to send password reset email.";
    }
} else {
    echo "No email address provided.";
}

// Close database connection
$conn->close();
?>
