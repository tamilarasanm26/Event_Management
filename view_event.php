<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}


include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: manage_events.php");
    exit();
}

$event_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM events WHERE id = :id");
$stmt->bindParam(':id', $event_id);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Event</title>
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
        p {
            text-align: left;
        }
        a {
            padding: 10px;
            background-color: #5cb85c;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
        }
        a:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Event</h2>
        <p><strong>Title:</strong> <?php echo htmlspecialchars($event['title']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?></p>
        <p><strong>Time:</strong> <?php echo htmlspecialchars($event['time']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($event['description']); ?></p>
        <a href="manage_events.php">Back to Manage Events</a>
    </div>
</body>
</html>
