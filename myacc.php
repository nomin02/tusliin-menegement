<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieving user-specific information (you can modify this based on your database structure)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "club";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$s_id = $_SESSION["student_code"];
$stmt = $conn->prepare("SELECT firstname, lastname, course, class_n FROM student WHERE student_code = ?");
$stmt->bind_param("s", $s_id);
$stmt->execute();
$stmt->bind_result($firstname, $lastname, $course, $class_n);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background-color: #BB8FCE;">
    <div class="container">
        <h2>My Account</h2>
        <div class="form-container">
            <p>Welcome, <?php echo $lastname . " " . $firstname; ?>!</p>
            <p>Student ID: <?php echo $s_id; ?></p>
            <p>Course: <?php echo $course; ?></p>
            <p>Class: <?php echo $class_n; ?></p>

            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>

</html>
