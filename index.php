<?php
// Include database connection
include './function/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./partial/assets/style.css">
    <link rel="shortcut icon" href="./image/new1.png" type="image/x-icon">
    <title>Gingoog City Web-based Veterinary Appointment And Information System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.container {
    text-align: center;
    padding-top: 1px;
    color: white;
}
/* contaier_3box style */
/* Container for the boxes */
.container_3box {
    margin-top: 60px;
    display: flex;
    justify-content: space-around; /* Space out the boxes evenly */
    align-items: center; /* Center items vertically */
    padding: 20px; /* Add padding around the container */
    /* background-color: #f9f9f9;  Light background color */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    flex-wrap: wrap; /* Allow wrapping of boxes on smaller screens */
}

/* Style for each box */
.box {
    text-align: center; /* Center text inside the box */
    padding: 20px;
    background-color: #ffffff; /* White background for each box */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    flex: 1 1 200px; /* Flex-grow to make all boxes equal width, minimum width of 200px */
    margin: 10px; /* Space between boxes */
}

/* Style for the headers and spans */
.box h1 {
    font-size: 18px;
    margin: 0; /* Remove default margin */
    color: #333; /* Dark text color */
}

.box span {
    font-size: 24px;
    font-weight: bold;
    color: #007bff; /* Primary color for emphasis */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container_3box {
        padding: 10px; /* Reduce padding on smaller screens */
    }

    .box {
        flex: 1 1 150px; /* Allow boxes to be narrower on smaller screens */
        margin: 5px; /* Reduce space between boxes */
    }

    .box h1 {
        font-size: 16px; /* Adjust font size for headers on smaller screens */
    }

    .box span {
        font-size: 20px; /* Adjust font size for spans on smaller screens */
    }
}

@media (max-width: 480px) {
    .container_3box {
        padding: 5px; /* Further reduce padding on very small screens */
    }

    .box {
        flex: 1 1 100%; /* Make each box take full width on very small screens */
        margin: 5px 0; /* Stack boxes vertically with margin */
    }

    .box h1 {
        font-size: 14px; /* Further adjust font size for headers */
    }

    .box span {
        font-size: 18px; /* Further adjust font size for spans */
    }
}
body {
    padding: 0;
    margin: 0;
    background-image: url('./image/citizine.png'); /* Update image path as necessary */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
}

</style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./image/new1.png" alt="Logo" style="width: 50px;">
                <span class="ms-2">GCVAIS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./service.php">Citizen Charter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1>Welcome to Gingoog City Veterinary Appointment And Information System</h1>
        <p>Your pet's health is our priority. Book an appointment, get information, and more!</p>

        <!-- Register and Login Buttons -->
        <div class="auth-buttons">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                Login
            </button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#registerModal">
                Register
            </button>
            <!-- <a href="../php/apoint.php"><button type="button" class="btn btn-third">Appointment</button></a> -->
        </div>
    </div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="./function/forgot_password_handle.php">
                    <div class="mb-3">
                        <label for="forgotPasswordEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="forgotPasswordEmail" name="forgotPasswordEmail" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img src="./image/new1.png" alt="Logo" class="mb-3" style="width: 100px;">
                </div>
                <form method="POST" action="./function/login_handle.php">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                        <input type="checkbox" id="chk2"> show password
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" style="text-decoration: none;">Forgot password or account?</a> -->
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" onshow="generateUniqueID()">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img src="./image/new1.png" alt="Logo" class="mb-3" style="width: 100px;">
                </div>
                <form id="registrationForm" method="post" action="./function/handle_registration.php">
                    <div class="col-md-6">
                        <label for="registergenerateid" class="form-label">Client ID</label>
                        <input type="text" class="form-control" id="registergenerateid" name="registergenerateid" style="width: 30%;" required readonly>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registerFirstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="registerFirstname" name="registerFirstname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registerMiddlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="registerMiddlename" name="registerMiddlename">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registerLastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="registerLastname" name="registerLastname" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registerGender" class="form-label">Gender</label>
                            <select class="form-select" id="registerGender" name="registerGender" required>
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registerDOB" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="registerDOB" name="registerDOB" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registerAge" class="form-label">Age</label>
                            <input type="number" class="form-control" id="registerAge" name="registerAge" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registerContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="registerContact" name="registerContact" required>
                        </div>
                        <div class="col-md-6">
                            <label for="registerAddress" class="form-label">Present Address</label>
                            <input type="text" class="form-control" id="registerAddress" name="registerAddress" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="registerUsername" name="registerUsername" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
                            <input type="checkbox" id="chk" onclick="togglePassword()"> Show password
                        </div>
                        <div class="col-md-6">
                            <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="registerConfirmPassword" name="registerConfirmPassword" required>
                            <input type="checkbox" id="chk1" onclick="toggleConfirmPassword()"> Show password
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="registerAgree" name="registerAgree" required>
                        <label class="form-check-label" for="registerAgree">I agree to the terms</label>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" style="text-decoration: none;">Already have an account!</a>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- container_3box -->
<div class="container_3box">
    <div class="box">
        <h1>Pet Appointment</h1> <span>+3000</span>
    </div>
    <div class="box">
        <h1>User</h1> <span>+3000</span>
    </div>
    <div class="box">
        <h1>Vaccination</h1> <span>+3000</span>
    </div>
</div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ----------------------geberate ID
        function generateUniqueID() {
    const uniqueID = Math.floor(1000000 + Math.random() * 9000000); // Generate a 7-digit random number
    document.getElementById('registergenerateid').value = uniqueID; // Set the value in the input field
}

// Ensure the modal has an event listener to call the generate ID function
document.getElementById('registerModal').addEventListener('show.bs.modal', generateUniqueID);

// Toggle Password visibility
function togglePassword() {
    const passwordField = document.getElementById("registerPassword");
    const chk = document.getElementById("chk");
    passwordField.type = chk.checked ? "text" : "password";
}

// Toggle Confirm Password visibility
function toggleConfirmPassword() {
    const confirmPasswordField = document.getElementById("registerConfirmPassword");
    const chk1 = document.getElementById("chk1");
    confirmPasswordField.type = chk1.checked ? "text" : "password";
}

        //  ------------------------------------------------------
        const registerPassword = document.getElementById("registerPassword");
        const chk = document.getElementById("chk");

        chk.onchange = function(e) {
            registerPassword.type = chk.checked ? "text" : "password";
        };

        const registerConfirmPassword = document.getElementById("registerConfirmPassword");
        const chk1 = document.getElementById("chk1");

        chk1.onchange = function(e) {
            registerConfirmPassword.type = chk1.checked ? "text" : "password";
        };

        const loginPassword = document.getElementById("loginPassword");
        const chk2 = document.getElementById("chk2");

        chk2.onchange = function(e) {
            loginPassword.type = chk2.checked ? "text" : "password";
        };
    </script>
</body>
</html>