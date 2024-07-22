<?php
// Include your database connection or configuration file
include 'config.php';

// Query to fetch events
$stmt = $conn->prepare("SELECT * FROM events ORDER BY date, time");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($events) {
    foreach ($events as $event) {
        echo '<div class="event">';
        echo '<h3>' . htmlspecialchars($event['title']) . '</h3>';
        echo '<p>Date: ' . htmlspecialchars($event['date']) . '</p>';
        echo '<p>Time: ' . htmlspecialchars($event['time']) . '</p>';
        echo '<p>Location: ' . htmlspecialchars($event['location']) . '</p>';
        echo '<p>Description: ' . htmlspecialchars($event['description']) . '</p>';
        echo '<a href="bookevents.php?event_id=' . $event['id'] . '&event_name=' . urlencode($event['title']) . '">Purchase Ticket</a>';
        echo '</div>';
    }
} else {
    echo '<p>No events found.</p>';
}
?>
