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

// Display the logged-in user's username
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
            margin: 15% 0 0 35%; /* 15% from the top, 50px from the left */
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
        /* calendar style */
/* General Calendar Styles */
#calendar {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100vh; /* Full height of the viewport */
    background-color: #ffffff;
    font-family: 'Roboto', sans-serif;
    display: flex;
    flex-direction: column;
}

/* Header Styles */
#calendar .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #f1f3f4;
    border-bottom: 1px solid #e0e0e0;
}

#calendar .header h2 {
    font-size: 1.25rem;
    font-weight: 500;
    color: #202124;
    margin: 0;
}

#calendar .header .controls {
    display: flex;
    align-items: center;
}

#calendar .header .controls button {
    background-color: #4285f4;
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 10px;
}

#calendar .header .controls button:hover {
    background-color: #357ae8;
}

/* Table Styles */
#calendar table {
    width: 100%;
    height: 100%;
    border-collapse: collapse;
    table-layout: fixed;
    flex-grow: 1; /* Allow the table to grow and take up available space */
}

#calendar th,
#calendar td {
    border: 1px solid #e0e0e0;
    text-align: center;
    vertical-align: top;
    padding: 10px;
    font-size: 0.875rem;
    color: #3c4043;
}

/* Header Day Styles */
#calendar th {
    background-color: #f8f9fa;
    font-weight: 500;
    color: #5f6368;
    font-size: 0.875rem;
    padding: 15px;
}

/* Today Highlight */
#calendar .today {
    background-color: #e8f0fe;
    border-color: #4285f4;
}

/* Selected Date Highlight */
#calendar .selected {
    background-color: #4285f4;
    color: #fff;
}

/* Disabled Dates */
#calendar .disabled {
    color: #d2d2d2;
    pointer-events: none;
}

/* Button Container at the Bottom */
#calendar .button-container {
    padding: 10px 20px;
    background-color: #f1f3f4;
    border-top: 1px solid #e0e0e0;
    text-align: center;
}

#calendar .button-container button {
    background-color: #4285f4;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 5px;
}

#calendar .button-container button:hover {
    background-color: #357ae8;
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
    
            #calendar {
        padding: 0;
    }

    #calendar .header {
        flex-direction: column;
        align-items: flex-start;
    }

    #calendar .header h2 {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    #calendar .header .controls {
        width: 100%;
        justify-content: space-between;
    }

    #calendar th,
    #calendar td {
        padding: 5px;
        font-size: 0.75rem;
    }

    #calendar th {
        padding: 10px;
    }

    #calendar .button-container {
        padding: 10px;
    }

    #calendar .button-container button {
        padding: 8px 15px;
        font-size: 0.75rem;
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
        <main>
            <!-- php holidays -->
            <section class="content">
                <h1 style='font-weight: lighter; '>Appointment Availability | Calendar</h1>
                <hr>
                <div id="calendar"></div>
            </section>
        </main>
    </div>
    <!-- Main Content Section -->
    <div class="main-content">
        <!-- Hidden form modal -->
        <div id="appointmentModal" class="modal">
            <div class="modal-content">
                <span class="close"><i class="fas fa-times"></i></span>
                <h2>Appointment Form</h2>
                <form action="../function/submit_appointment.php" method="POST">
                <div class="generate_id_fetch">
                    <label for="registergenerateid" class="form-label">Client ID</label>
                    <input type="text" class="form-control custom-width" id="registergenerateid" name="registergenerateid" style="width: 30%;" required readonly>
                </div>


                    <hr>
                    <label for="client_name"><i class="fas fa-user"></i> <strong>Client Name</strong></label>
                    <input type="text" id="client_name" name="client_name" placeholder="Ex. Jay C. Molina" required>
                    <label for="address"><i class="fas fa-map-marker-alt"></i> <strong>Address</strong></label>
                    <input type="text" id="address" name="address" placeholder="Ex. P-1 barangay Sangalan Gingoog City" required>
                    <label for="cell_number"><i class="fas fa-phone"></i> <strong>Contact #</strong></label>
                    <input type="text" id="cell_number" name="cell_number" placeholder="Enter your contact number" required>
                    <label for="email"><i class="fas fa-envelope"></i> <strong>Email</strong></label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    
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

                    <!-- schedule Auto select -->
                    <label for="date"><i class="fas fa-calendar-alt"></i> <strong>Appointment Schedule</strong></label>
                    <input type="date" id="date" name="date" required>
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
                    <label for="request"><i class="fas fa-comment"></i> <strong>Request</strong></label>
                    <input type="text" id="request" name="request" placeholder="What request would you like to assess?" required>
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
        </div>
        <!-- End of Hidden form modal -->
        <!-- Alert Message -->
        <div id="customAlert" class="custom-alert">
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
    </div>
    <script>
        // --------fetch generate id
    // When the page is ready, fetch the generated ID
    document.addEventListener('DOMContentLoaded', function() {
        fetchGeneratedID();
    });

    function fetchGeneratedID() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "../function/fetch_generated_id.php", true); // Update the path accordingly
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('registergenerateid').value = xhr.responseText;
            } else {
                console.error('Failed to fetch generated ID');
            }
        };
        xhr.send();
    }
        // -------------------------------------time slot
        document.getElementById('time').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var time = this.value;
    var status = selectedOption.getAttribute('data-status');

    if (status === 'booked') {
        alert('Time Booked, Please select another time. Thank you!');
        // Refresh the page
        location.reload();
    } else {
        // Confirmation alert for selecting a new time slot
        var confirmSelection = confirm('Are you sure you want to select this time?');

        if (confirmSelection) {
            // Get the previously selected option with status 'booked'
            var previouslySelectedOption = this.querySelector('option[data-status="booked"]');
            if (previouslySelectedOption) {
                var prevTime = previouslySelectedOption.value;

                // Prompt the user to confirm changing the previously booked time slot
                var confirmChange = confirm('Do you want change the time?');

                if (confirmChange) {
                    // Revert the previous time slot status to 'available'
                    var xhrRevert = new XMLHttpRequest();
                    xhrRevert.open('POST', '../function/revert_time_slot_status.php', true);
                    xhrRevert.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhrRevert.onreadystatechange = function() {
                        if (xhrRevert.readyState === 4 && xhrRevert.status === 200) {
                            // Handle response if needed
                            // Update the status of the previous option
                            previouslySelectedOption.setAttribute('data-status', 'available');
                            
                            // Proceed with booking the new time slot
                            bookNewTimeSlot(time);
                        }
                    };
                    xhrRevert.send('slot_time=' + encodeURIComponent(prevTime));
                }
            } else {
                // Proceed with booking the new time slot if no previously booked slot exists
                bookNewTimeSlot(time);
            }
        }
    }
});

function bookNewTimeSlot(time) {
    // Update the status to 'booked' via AJAX
    var xhrBook = new XMLHttpRequest();
    xhrBook.open('POST', '../function/update_time_slot_status.php', true);
    xhrBook.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhrBook.onreadystatechange = function() {
        if (xhrBook.readyState === 4 && xhrBook.status === 200) {
            // Handle response if needed
            alert('Time slot successfully booked.');

            // Update the option's status attribute
            var selectedOption = document.querySelector('#time option[value="' + time + '"]');
            if (selectedOption) {
                selectedOption.setAttribute('data-status', 'booked');
            }
        }
    };
    xhrBook.send('slot_time=' + encodeURIComponent(time));
}



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
