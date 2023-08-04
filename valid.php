<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to the database
    $servername = "localhost";
    $data_username = "root";
    $data_password = "root";
    $database = "Project";
    $conn = new mysqli($servername, $data_username, $data_password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the user's email and password from the database
    $query = "SELECT roll, email, password FROM student WHERE email='$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbEmail = $row['email'];
        $dbPassword = $row['password'];
        $roll = $row['roll'];

        // Validate the credentials
        if ($dbEmail === $email && $dbPassword === $password) {
            // Redirect to test.html if valid
            session_start();
            $_SESSION['id'] = $roll;
            echo '<script>alert("Login successful! Redirecting to test.html."); window.location.href = "test.html";</script>';
            exit();
        } else {
            // Invalid credentials, display an alert message
            echo '<script>alert("Invalid credentials! Please try again."); window.location.href = "login.html";</script>';
            exit();
        }
    } else {
        // Email not found, display an alert message
        echo '<script>alert("Email not found! Please try again."); window.location.href = "login.html";</script>';
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
