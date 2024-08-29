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

// Prepare the SQL query to fetch the logged-in user's profile and appointments
$sql = "SELECT users.id, users.firstname, users.middlename, users.lastname, users.gender, users.dob, users.age, users.contact, users.address AS address, users.email, users.username, 
        appointments.appointment_id, appointments.client_name, appointments.address AS appointment_address, appointments.cell_number, appointments.email AS appointment_email, 
        appointments.date, appointments.time, appointments.type_animal, appointments.services, appointments.request
        FROM users
        LEFT JOIN appointments ON users.id = appointments.client_name
        WHERE users.id = ?";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}
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
        /* --------------------alert css-------------- */
        /* Custom Alert CSS */
        .custom-alert {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.5); /* Black background with opacity */
        }
        .custom-alert-content {
            border-radius: 10px;
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 0; /* Remove default padding */
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            animation: fadeIn 0.5s;
        }
        .custom-alert-header {
            background-color: #043765; /* Blue color */
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #888;
            border-radius: 5px;
        }
        .custom-alert-body {
            padding: 20px;
        }
        @keyframes fadeIn {
            from {opacity: 0;} 
            to {opacity: 1;}
        }
        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            margin-top: -10px;
            margin-right: -10px;
        }
        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* holiday style */
        .holiday-item {
            background-color: rgb(11, 92, 21);
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            color: white;
        }
        /* modal style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            animation: fadeIn 0.5s;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            margin-left: 95%;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content h2 {
            margin-top: 0;
        }
        .modal-content hr {
            border: 0;
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }
        .modal-content label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        .modal-content input[type="text"],
        .modal-content input[type="email"],
        .modal-content input[type="date"],
        .modal-content select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .modal-content input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal-content input[type="submit"]:hover {
            background-color: #45a049;
        }
        .modal-content i {
            margin-right: 5px;
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

/* General Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

thead {
    background-color: #f4f4f4;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    word-wrap: break-word; /* Ensure long text wraps within cell */
}

th {
    background-color: #043765;
    color: white;
    font-weight: lighter;
}

/* Responsive Styles */
@media (max-width: 768px) {
    table {
        width: 100%;
        border: 0;
    }

    thead {
        display: none; /* Hide table headers on small screens */
    }

    tbody, tr {
        display: block;
        width: 100%;
    }

    tr {
        border: 1px solid #ddd;
        margin-bottom: 10px;
        display: block;
    }

    td {
        display: block;
        text-align: right;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        position: relative;
        padding-left: 50%;
        box-sizing: border-box; /* Ensure padding doesn't cause overflow */
        word-wrap: break-word; /* Ensure long text wraps within cell */
    }

    td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 0;
        padding-left: 10px;
        font-weight: bold;
        white-space: nowrap;
        background: black;
        border-right: 1px solid #ddd;
        box-sizing: border-box;
        font-weight: lighter;
        border-radius: 500%;
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
            <a href="../php/apoint.php#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-bell"></i></a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-sign-out-alt"></i></a>
                <div class="dropdown-menu">
                <a href="#">
                    <i class="fas fa-user-circle"></i>
                    <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>
                </a>
<!-- 
                    <a href="#"><i class="fas fa-cog"></i>&nbsp;Settings</a> -->
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
                <!-- <li><a href="../php/apoint.php"><i class="fas fa-cog"></i> Settings</a></li> -->
            </ul>
        </aside>
    <!-- end modal -->
    <main class="div_desk">
        <section class="content_desk">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Service</th>
                        <th>Descriptions</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    // Database connection
    $dsn = 'mysql:host=localhost;dbname=veterans_db';
    $username = 'root';  // Adjust if needed
    $password = '';      // Adjust if needed
    
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Fetch services data
        $stmt = $pdo->query('SELECT * FROM services');
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td data-label="  #">' . htmlspecialchars($row['ServiceID']) . '</td>';
            echo '<td data-label="  Date Created">' . htmlspecialchars($row['Date_Created']) . '</td>';
            echo '<td data-label="  Service">' . htmlspecialchars($row['ServiceName']) . '</td>';
            echo '<td data-label="  Descriptions">' . htmlspecialchars($row['Description']) . '</td>';
            echo '<td data-label="  Price">' . htmlspecialchars($row['Price']) . '</td>';
            echo '</tr>';
        }
    } catch (PDOException $e) {
        echo '<tr><td colspan="5">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
    }
    ?>
</tbody>
            </table>
        </section>
    </main>
    <!-- end modal -->
    
    <!-- Alert Message -->
    <!-- <div id="customAlert" class="custom-alert">
            </div>
            <div class="custom-alert-content">
                <div class="custom-alert-header">
                    <i class="fas fa-exclamation-triangle alert-icon"></i> &nbsp;Alert
                    <span class="close-btn" onclick="closeAlert()">&times;</span>
                </div>
                <div class="custom-alert-body">
                    <p style="color:black;">𝗡𝗼𝘁 𝗔𝘃𝗮𝗶𝗹𝗮𝗯𝗹𝗲 𝗮𝗻𝘆𝗺𝗼𝗿𝗲, 𝗽𝗹𝗲𝗮𝘀𝗲 𝗰𝗵𝗼𝗼𝘀𝗲 𝗮𝗻𝗼𝘁𝗵𝗲𝗿 𝗱𝗮𝘁𝗲𝘀. 𝗧𝗵𝗮𝗻𝗸 𝘆𝗼𝘂!</p>
                </div>
            </div>
        </div>
    </div> -->
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

        // -------------------calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var today = new Date();
            today.setHours(0, 0, 0, 0);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: '',
                    center: 'title',
                    right: 'prev,next today'
                },
                businessHours: {
                    daysOfWeek: [1, 2, 3, 4, 5] // Monday - Friday
                },
                weekends: false, // Hide weekends
                dateClick: function(info) {
                    var clickedDate = new Date(info.date);
                    clickedDate.setHours(0, 0, 0, 0);
                    if (clickedDate < today) {
                        showAlert();
                    } else if (clickedDate >= today) {
                        document.getElementById('date').value = info.dateStr;
                        document.getElementById('appointmentModal').style.display = "block";
                    }
                },
                dayCellContent: function(arg) {
                    var date = new Date(arg.date);
                    date.setHours(0, 0, 0, 0);
                    var dateStr = date.toISOString().split('T')[0];
                    var isPastYesterday = date < today;

                    if (dateStr === today.toISOString().split('T')[0]) {
                        arg.dayNumberText = "𝗧𝗼𝗱𝗮𝘆!";
                    } else if (isPastYesterday) {
                        arg.dayNumberText = "☑️";
                    }
                },
                events: {
                    url: '../function/fetch_holidays.php', // Adjust the path if necessary
                    failure: function() {
                        alert('There was an error while fetching holidays!');
                    }
                }
            });

            calendar.render();
        });

        // -------------------------------------------
        function showAlert() {
            document.getElementById('customAlert').style.display = "block";
        }

        function closeAlert() {
            document.getElementById('customAlert').style.display = "none";
        }

        var modal = document.getElementById("appointmentModal");
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        document.getElementById('appointmentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(event.target);
            var data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });
            console.log(data);

            modal.style.display = "none";
        });
    </script>
</body>
</html>
