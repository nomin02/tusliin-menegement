<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve admin credentials from the form
    $admin_username = $_POST["admin_id"];
    $admin_password = $_POST["admin_pass"];

    // Replace these with your actual database connection details
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "club";

    // Create a database connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize the input to prevent SQL injection
    $admin_username = mysqli_real_escape_string($conn, $admin_username);
    $admin_password = mysqli_real_escape_string($conn, $admin_password);

    // Query to check if the provided credentials match a record in the database
    $sql = "SELECT id, username FROM admin WHERE username = '$admin_username' AND password = '$admin_password'";
    $result = mysqli_query($conn, $sql);

    // Check if there is a matching record
    if (mysqli_num_rows($result) == 1) {
        // Successful login, you can redirect to a dashboard or perform other actions
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["admin_id"] = $row["id"];
        $_SESSION["admin_username"] = $row["username"];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Invalid credentials, redirect back to the login page with an error parameter
        header("Location: admin.php?error=1");
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form is not submitted, redirect to the login page
    header("Location: admin.php");
}
?>
