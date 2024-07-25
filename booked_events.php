<?php

include 'config.php';

// Query to fetch booked events
$stmt = $conn->prepare("SELECT eventname, booker_name, mobile_number FROM bookings ORDER BY eventname");
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($bookings) {
    echo '<h3>Booked Events List</h3>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Event Name</th><th>Booker Name</th><th>Mobile Number</th></tr>';
    foreach ($bookings as $booking) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($booking['eventname']) . '</td>';
        echo '<td>' . htmlspecialchars($booking['booker_name']) . '</td>';
        echo '<td>' . htmlspecialchars($booking['mobile_number']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>No bookings found.</p>';
}
?>
