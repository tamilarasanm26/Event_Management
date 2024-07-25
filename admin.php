<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}


include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 800px;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        .welcome-message {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
        }
        a, button {
            padding: 10px;
            background-color: #5cb85c;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
            display: inline-block;
            margin: 5px;
            border: none;
        }
        a:hover, button:hover {
            background-color: #4cae4c;
        }
        .manage-events, #createEventForm, #bookedEventsSection {
            display: none;
            margin-top: 20px;
        }
    </style>
    <script>
        function showCreateEventForm() {
            document.getElementById("createEventForm").style.display = "block";
            document.getElementById("manageEventsSection").style.display = "none";
            document.getElementById("bookedEventsSection").style.display = "none";
        }

        function showManageEvents() {
            document.getElementById("manageEventsSection").style.display = "block";
            document.getElementById("createEventForm").style.display = "none";
            document.getElementById("bookedEventsSection").style.display = "none";
        }

        function showBookedEvents() {
            document.getElementById("bookedEventsSection").style.display = "block";
            document.getElementById("createEventForm").style.display = "none";
            document.getElementById("manageEventsSection").style.display = "none";
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <div class="welcome-message">
            Welcome to the Admin Page, <?php echo $_SESSION['username']; ?>!
        </div>
        
        <a href="logout.php">Logout</a>

        <!-- Buttons to toggle forms -->
        <button onclick="showCreateEventForm()">Add Event</button>
        <button onclick="showManageEvents()">Manage Events</button>
        <button onclick="showBookedEvents()">Booked Events</button>
        
        <!-- Create Event Form -->
        <div id="createEventForm">
            <?php include 'create_event.php'; ?>
        </div>

        <!-- Manage Events Section -->
        <div id="manageEventsSection" class="manage-events">
            <?php include 'manage_events.php'; ?>
        </div>

        <!-- Booked Events Section -->
        <div id="bookedEventsSection" class="booked-events">
            <?php include 'booked_events.php'; ?>
        </div>
    </div>
</body>
</html>
