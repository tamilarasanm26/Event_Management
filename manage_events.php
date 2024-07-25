<?php
// session_start();
// if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit();
// }


include 'config.php';


if (isset($_GET['delete_event'])) {
    $event_id = $_GET['delete_event'];
    $stmt = $conn->prepare("DELETE FROM events WHERE id = :id");
    $stmt->bindParam(':id', $event_id);
    $stmt->execute();
    header("Location: manage_events.php");
    exit();
}

// Fetch all events from the database
$stmt = $conn->prepare("SELECT * FROM events ORDER BY date, time");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        a {
            padding: 5px 10px;
            background-color: #5cb85c;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            cursor: pointer;
            margin: 2px;
        }
        a:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Events</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            <?php if ($events): ?>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($event['title']); ?></td>
                        <td><?php echo htmlspecialchars($event['date']); ?></td>
                        <td><?php echo htmlspecialchars($event['time']); ?></td>
                        <td><?php echo htmlspecialchars($event['location']); ?></td>
                        <td><?php echo htmlspecialchars($event['description']); ?></td>
                        <td>
                            <a href="view_event.php?id=<?php echo $event['id']; ?>">View</a>
                            <a href="edit_event.php?id=<?php echo $event['id']; ?>">Edit</a>
                            <a href="manage_events.php?delete_event=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No events found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
