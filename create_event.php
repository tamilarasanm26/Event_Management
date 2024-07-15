<?php
// Include your database connection or configuration file
include 'config.php';

$error = '';

// Handle form submission for event creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_event'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Validate and sanitize input as needed

    // Prepare and execute SQL query to insert event into database
    $stmt = $conn->prepare("INSERT INTO events (title, date, time, location, description) 
                            VALUES (:title, :date, :time, :location, :description)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':description', $description);

    if ($stmt->execute()) {
        // Event created successfully, redirect or show success message
        header("Location: admin.php");
        exit();
    } else {
        // Handle error if event creation fails
        $error = "Error creating event";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
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
            max-width: 600px;
        }
        h3 {
            margin-top: 0;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"], input[type="time"], textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 14px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }


        .cancel-btn {
            padding: 5px;
            background-color: #5cb85c;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            width: 90%;
            margin-top: 5px;
        }
        .cancel-btn:hover {
            background-color: #4cae4c;
        }
    </style>
    <script>
   

    function hideCreateEventForm() {
        var createEventForm = document.getElementById("createEventForm");
        createEventForm.style.display = "none";
    }
</script>
</head>
<body>
    <div class="container">
        <h3>Create New Event</h3>
        <form method="post" action="">
            <?php if (!empty($error)) : ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>
            
            <label for="time">Time:</label>
            <input type="time" id="time" name="time" required><br>
            
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>
            
            <input type="submit" name="create_event" value="Create Event">
            <button type="button" class="cancel-btn" onclick="hideCreateEventForm()">Cancel</button>
       
        </form>
    </div>
</body>
</html>
