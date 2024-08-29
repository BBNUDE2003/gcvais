<?php
// Include database connection
include './function/db_connect.php';
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

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #3b5998;
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
    min-width: 160px;
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

        .help-desk {
            max-width: 1000px;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="./image/new1.png" alt="logo" style="width: 40px; margin-right: 10px;">
            GCVAIS
        </div>
        <div class="menu-bar">
            <i class="fas fa-bars"></i>
        </div>
        <div class="header-icons">
            <a href="#"><i class="fas fa-home"></i></a>
            <a href="#"><i class="fas fa-bell"></i></a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle"><i class="fas fa-sign-out-alt"></i></a>
                <div class="dropdown-menu">
                    <a href="#">Profile</a>
                    <a href="#">Settings</a>
                    <a href="#" id="logout">Logout</a>
                </div>
            </div>
        </div>

    </header>
    <div class="container">
    <aside class="sidebar">
        <h1>DASHBOARD</h1>
            <ul>
                <li><a href="./php/apoint.php"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
                <!-- <li><a href="#"><i class="fas fa-calendar-day"></i> Holidays</a></li> -->
                <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fas fa-phone-alt"></i> Help Desk</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>
        <main>

        <!-- php holidays -->

        
            <!-- <section class="content">
                        <h1>Appointment Availability | Calendar</h1> 
                         <div id="calendar"></div>
                    </section> -->
                    <section class="help-desk">
                        <h2>HOLIDAYS</h2>
                        <div id='calendar'></div>
                    </section>

        </main>
    </div>
    <script>

// -------------------------------- href to index.php
document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor behavior
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = './php/index.php'; // Redirect to index.php
        }
    });
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
// -------------------------------Toggle sidebar
            const menuBar = document.querySelector('.menu-bar');
            const sidebar = document.querySelector('.sidebar');
            menuBar.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
// -------------------calendar

document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: {
                    url: './function/fetch_holidays.php', // Adjust the path if necessary
                    failure: function() {
                        alert('There was an error while fetching holidays!');
                    }
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
