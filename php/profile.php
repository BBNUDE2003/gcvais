<?php
// Start the session
session_start();

// Include database connection
include '../function/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../index.php");
    exit();
}

// Get the logged-in user's ID and username from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APPOINTMENT | GCVAIS</title>
    <link rel="shortcut icon" href="../image/new1.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            padding: 0;
    margin: 0;
    background-image: url('../image/citizine.png'); /* Update image path as necessary */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #043765;
            color: white;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }
        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
        }
        .menu-bar {
            display: none;
            cursor: pointer;
        }
        .header-icons a {
            color: white;
            text-decoration: none;
            margin-right: 35px;
            font-size: 20px;
        }
        .container {
            display: flex;
            margin-top: 60px; /* Add margin to account for fixed header */
        }
        .sidebar {
            width: 250px;
            background-color: #f4f4f4;
            height: calc(100vh - 60px); /* Adjust height to account for fixed header */
            padding-top: 20px;
            position: fixed;
            top: 60px; /* Place below the fixed header */
            left: 0;
            transition: transform 0.3s ease;
            z-index: 999;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
            margin-left: 25px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .sidebar ul li a:hover {
            background-color: rgba(255, 255, 255, 0.822);
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        main {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Add margin to avoid overlap with fixed sidebar */
        }
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .help-desk {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .help-desk h2 {
            margin-top: 0;
        }
        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-toggle {
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 45px;
            background-color: #fff;
            min-width: 170px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 4px;
            animation: fadeIn 0.5s;
        }
        .dropdown-menu a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-menu a:hover {
            background-color: #ddd;
        }
        /* Show dropdown menu on click */
        .dropdown.show .dropdown-menu {
            display: block;
        }
        /* calendar style */

        @media (max-width: 768px) {
            .menu-bar {
                display: block;
            }
            .sidebar {
                position: fixed;
                top: 60px;
                left: 0;
                height: calc(100vh - 30px);
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .container {
                flex-direction: column;
            }
            main {
                padding: 10px;
                margin-left: 0; /* Remove margin to avoid overlap with sidebar */
            }
            .custom-alert {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1000; /* Sit on top */
                left: -13em;
                top: 0;
                width: 200%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgba(0,0,0,0.5); /* Black background with opacity */
            }
        }

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../image/new1.png" alt="logo" style="width: 40px; margin-right: 10px;">
            GCVAIS
        </div>
        <div class="menu-bar">
            <i class="fas fa-bars"></i>
        </div>
        <div class="header-icons">
            <a href="../php/apoint.php"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-bell"></i></a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-sign-out-alt"></i></a>
                <div class="dropdown-menu">
                <a href="#">
                    <i class="fas fa-user-circle"></i>
                    <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>
                </a>

                    <!-- <a href="#"><i class="fas fa-cog"></i>&nbsp;Settings</a> -->
                    <a href="#" id="logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <aside class="sidebar">
            <h1 style='font-weight: lighter; '>DASHBOARD</h1>
            <ul>
                <li><a href="../php/apoint.php"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
                <li><a href="../php/profile.php"><i class="fas fa-user"></i> My Appointment</a></li>
                <li><a href="../php/hel_desk.php"><i class="fas fa-phone-alt"></i> Help Desk</a></li>
                <li><a href="../php/services.php"><i class="fas fa-cogs"></i> Services</a></li>
                <!-- <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li> -->
            </ul>
        </aside>
    </div>
<!-- styel for main -->
 
 <style>
/* Main Container */
.main_data {
    padding: 20px;
}

/* Table Styling */
.details_person table {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    margin-top: 2%;
}

.details_person th, .details_person td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.details_person th {
    background-color: #043765;
    color: white;
    font-weight: lighter;
}

.details_person td {
    vertical-align: middle;
}

/* Actions Buttons */
.details_person .actions a {
    text-decoration: none;
    padding: 5px 10px;
    color: #fff;
    border-radius: 3px;
    margin: 0 5px;
}

.details_person .actions .edit {
    background-color: #f0ad4e; /* Orange for Edit */
}

.details_person .actions .delete {
    background-color: #d9534f; /* Red for Delete */
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .details_person table, .details_person thead, .details_person tbody, .details_person th, .details_person td, .details_person tr {
        display: block;
    }

    .details_person thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .details_person tr {
        border: 1px solid #ddd;
        margin-bottom: 10px;
        display: block;
        padding: 10px;
    }

    .details_person td {
        border: none;
        display: block;
        font-size: 14px;
        text-align: right;
        position: relative;
        padding-left: 50%;
    }

    .details_person td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: bold;
        text-align: left;
    }
}
/* Button Styling */
.btn {
    text-decoration: none;
    padding: 8px 15px;
    color: #fff;
    border-radius: 4px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    display: inline-block;
    margin: 0 5px;
}

.btn-edit {
    background-color: #f0ad4e; /* Orange */
}

.btn-edit:hover {
    background-color: #ec971f; /* Darker Orange on hover */
}

.btn-delete {
    background-color: #d9534f; /* Red */
}

.btn-delete:hover {
    background-color: #c9302c; /* Darker Red on hover */
}

/* Responsive Design Adjustments */
@media screen and (max-width: 768px) {
    .btn {
        display: block;
        margin: 5px 0;
    }
}

 </style>
 <!-- ens of styel -->
 <main class="main_data">
    <!-- data person -->
    <?php
    
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "veterans_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if user is logged in
    if (!isset($_SESSION['client_id'])) {
        echo "You are not logged in.";
        exit();
    }

    $client_id = $_SESSION['client_id'];

    // SQL query to fetch appointment details and user information where client_id matches
    $sql = "SELECT 
            users.firstname, 
            users.lastname, 
            users.gender, 
            users.dob, 
            users.age, 
            users.contact, 
            users.address AS user_address, 
            users.email AS user_email,
            appointments.appointment_id,  -- Assuming appointment_id is the primary key
            appointments.client_id, 
            appointments.client_name, 
            appointments.address AS appointment_address, 
            appointments.cell_number, 
            appointments.email AS appointment_email, 
            appointments.date, 
            appointments.time, 
            appointments.type_animal, 
            appointments.services, 
            appointments.request,
            appointments.status
        FROM users
        INNER JOIN appointments ON users.client_id = appointments.client_id
        WHERE users.client_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the client_id parameter
    $stmt->bind_param("i", $client_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    echo "<h1 style='font-weight: lighter; '>Appointments | Details</h1>";
    // Check if there are results
    if ($result->num_rows > 0) {
        
        echo "<section class='details_person'>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Client ID</th>";
        echo "<th>Client Name</th>";
        echo "<th>Contact</th>";
        echo "<th>Appointment Address</th>";
        echo "<th>Appointment Email</th>";
        echo "<th>Appointment Date</th>";
        echo "<th>Appointment Time</th>";
        echo "<th>Type of Animal</th>";
        echo "<th>Request</th>";
        echo "<th>Services</th>";
        echo "<th>Status</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        // Fetch and display the results
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["client_id"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["client_name"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["appointment_address"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["appointment_email"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["type_animal"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["request"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["services"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
            echo "<td>
                    <a class='btn btn-edit' href='../function/edit_appointment.php?appointment_id=" . htmlspecialchars($row["appointment_id"]) . "'>Edit</a>
                    <a class='btn btn-delete' href='../function/delete_appointment.php?appointment_id=" . htmlspecialchars($row["appointment_id"]) . "' onclick='return confirm(\"Are you sure you want to delete this appointment?\");'>Delete</a>
                </td>";
    
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</section>";
    } else {
        echo "<p>No matching records found.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>
</main>







    <!-- script -->
    <script>
        // -----------------------------------dropdown logout icon
        document.querySelector('.dropdown-toggle').addEventListener('click', function() {
            var dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('show');
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-toggle')) {
                var dropdowns = document.querySelectorAll('.dropdown-menu');
                dropdowns.forEach(function(dropdown) {
                    if (dropdown.style.display === 'block') {
                        dropdown.style.display = 'none';
                    }
                });
            }
        });

        // -------------------------------- href to index.php
        document.getElementById('logout').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor behavior
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = '../function/logout.php'; // Redirect to logout.php
            }
        });

        // -------------------------------Toggle sidebar
        const menuBar = document.querySelector('.menu-bar');
        const sidebar = document.querySelector('.sidebar');
        menuBar.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

    </script>
</body>
</html>
