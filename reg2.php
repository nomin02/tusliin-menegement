<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "club";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $fname = isset($_POST["fname"]) ? mysqli_real_escape_string($conn, $_POST["fname"]) : '';
    $lname = isset($_POST["lname"]) ? mysqli_real_escape_string($conn, $_POST["lname"]) : '';
    $kurs = isset($_POST["kurs"]) ? mysqli_real_escape_string($conn, $_POST["kurs"]) : '';
    $merg = isset($_POST["merg"]) ? mysqli_real_escape_string($conn, $_POST["merg"]) : '';
    $ocode = isset($_POST["ocode"]) ? mysqli_real_escape_string($conn, $_POST["ocode"]) : '';
    $p = isset($_POST["p"]) ? mysqli_real_escape_string($conn, $_POST["p"]) : '';

    // Check if the student ID already exists
    $checkQuery = "SELECT * FROM student WHERE student_code = '$ocode'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Student ID is already registered
        echo '<script>alert("Student ID is already registered. Please use a different Student ID.");';
        echo 'window.location.href = "reg.php";</script>';
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO student (firstname, lastname, course, class_n, student_code, pass) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fname, $lname, $kurs, $merg, $ocode, $p);

    try {
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Registration successful
            echo '<script>';
            echo 'alert("Registration successful. Redirecting to login form.");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        // General error
        echo '<script>';
        echo 'alert("Error: ' . $e->getMessage() . '");';
        echo 'window.location.href = "reg.php";';
        echo '</script>';
        exit();
    } finally {
        $stmt->close();
    }
}

$conn->close();
?>
