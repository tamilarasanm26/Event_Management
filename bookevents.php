<?php
// Include your database connection or configuration file
include 'config.php';

$message = '';
$eventname = '';

if (isset($_GET['event_name'])) {
    $eventname = urldecode($_GET['event_name']);
}

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
        $message = 'Booking successful!';
    } else {
        $message = 'There was an error with your booking. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Event</title>
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
            max-width: 400px;
            width: 100%;
        }
        h2 {
            margin-top: 0;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="text"][readonly] {
            background-color: #e9ecef;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            border: none;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .message {
            color: green;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Event</h2>
        <form method="post" action="bookevents.php">
            <?php if (!empty($message)) : ?>
                <div class="<?php echo strpos($message, 'successful') !== false ? 'message' : 'error'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <label for="eventname">Event Name:</label>
            <input type="text" id="eventname" name="eventname" value="<?php echo htmlspecialchars($eventname); ?>" readonly>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            
            <label for="booker_name">Your Name:</label>
            <input type="text" id="booker_name" name="booker_name" required>
            
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" required>
            
            <input type="submit" value="Book Now">
        </form>
    </div>
</body>
</html>
