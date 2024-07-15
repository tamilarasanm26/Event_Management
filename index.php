<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

echo "Welcome, " . $_SESSION['username'] . "! You are logged in as " . $_SESSION['role'] . ".<br>";

if ($_SESSION['role'] == 'admin') {
    echo "<a href='admin.php'>Go to Admin Page</a><br>";
} elseif ($_SESSION['role'] == 'user') {
    echo "<a href='user.php'>Go to User Page</a><br>";
}
?>
<a href="logout.php">Logout</a>
