<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

// Include your database connection or configuration file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eventId = $_POST['event_id'];
    $userId = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price']; // Simplified for the example

    // Insert the purchase into the purchases table
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, event_id, quantity, total_price) VALUES (:user_id, :event_id, :quantity, :total_price)");
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':event_id', $eventId);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':total_price', $total_price);
    $stmt->execute();

    echo "Purchase successful!";
    // Optionally redirect to a confirmation page
    // header("Location: confirmation.php");
    // exit();
} else {
    // Fetch event details
    $eventId = $_GET['event_id'];
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->bindParam(':id', $eventId);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Ticket</title>
</head>
<body>
    <h2>Purchase Ticket for <?php echo htmlspecialchars($event['title']); ?></h2>
    <form method="post" action="">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required><br><br>
        <!-- Simplified price calculation for the example -->
        <input type="hidden" name="total_price" value="<?php echo $event['price']; ?>">
        <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">
        <input type="submit" value="Purchase">
    </form>
</body>
</html>
