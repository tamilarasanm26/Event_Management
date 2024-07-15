<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
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
        .events {
            margin-top: 20px;
            display: none;
        }
        .event {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: left;
        }
        .event h3 {
            margin-top: 0;
        }
    </style>
    <script>
        function toggleEvents() {
            var eventsDiv = document.getElementById("events");
            if (eventsDiv.style.display === "none" || eventsDiv.style.display === "") {
                eventsDiv.style.display = "block";
            } else {
                eventsDiv.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>User Page</h2>
        <div class="welcome-message">
            Welcome to the User Page, <?php echo htmlspecialchars($_SESSION['username']); ?>!
        </div>
       
        <a href="logout.php">Logout</a>
        
        <!-- Button to toggle events visibility -->
        <button onclick="toggleEvents()">Events</button>
        
        <!-- Include display events -->
        <div id="events" class="events">
            <?php include 'display_events.php'; ?>
        </div>
    </div>
</body>
</html>
