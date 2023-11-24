<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "club";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["login"])) {
    $s_id = isset($_POST["student_code"]) ? mysqli_real_escape_string($conn, $_POST["student_code"]) : '';
    $pass = isset($_POST["pass"]) ? mysqli_real_escape_string($conn, $_POST["pass"]) : '';

    $stmt = $conn->prepare("SELECT student_code FROM student WHERE student_code = ? AND pass = ?");
    $stmt->bind_param("ss", $s_id, $pass);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Login successful
        $_SESSION["loggedin"] = true;
        $_SESSION["student_code"] = $s_id;
        header("Location: ../nomin/index.php"); // Redirect to welcome page or dashboard
        exit();
    } else {
        // Login failed
        $_SESSION["error"] = "incorrect_pass";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
