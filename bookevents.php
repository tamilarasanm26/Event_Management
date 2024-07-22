<?php
// Include your database connection or configuration file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $eventname = $_POST['eventname'];
    $quantity = $_POST['quantity'];
    $booker_name = $_POST['booker_name'];
    $mobile_number = $_POST['mobile_number'];

    // Prepare SQL statement to insert booking data into the database
    $stmt = $conn->prepare("INSERT INTO bookings (eventname, quantity, booker_name, mobile_number) VALUES (:eventname, :quantity, :booker_name, :mobile_number)");

    // Bind parameters
    $stmt->bindParam(':eventname', $eventname);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':booker_name', $booker_name);
    $stmt->bindParam(':mobile_number', $mobile_number);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<p>Booking successful!</p>';
    } else {
        echo '<p>There was an error with your booking. Please try again.</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Event</title>
</head>
<body>
    <h1>Book Event</h1>
    <form method="post" action="bookevents.php">
        <label for="eventname">Event Name:</label><br>
        <input type="text" id="eventname" name="eventname" required><br><br>
        
        <label for="quantity">Quantity:</label><br>
        <input type="number" id="quantity" name="quantity" required><br><br>
        
        <label for="booker_name">Your Name:</label><br>
        <input type="text" id="booker_name" name="booker_name" required><br><br>
        
        <label for="mobile_number">Mobile Number:</label><br>
        <input type="text" id="mobile_number" name="mobile_number" required><br><br>
        
        <input type="submit" value="Book Now">
    </form>
</body>
</html>
