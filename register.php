<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Connect to the database
    $servername = "localhost";
    $data_username = "root";
    $data_password = "root";
    $database = "Project";
    $conn = new mysqli($servername, $data_username, $data_password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $department = $_POST['department'];
    $mobile = $_POST['mobile'];
    $college = $_POST['college'];
    $email = $_POST['email'];
    $password = $_POST['psw'];

    // Validate form data (You can add more validation as per your requirements)
    if (empty($name) || empty($roll) || empty($department) || empty($mobile) || empty($college) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit();
    }

    // Check if the email already exists in the database
    $checkQuery = "SELECT email FROM student WHERE email='$email'";
    $result = $conn->query($checkQuery);
    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        exit();
    }

    // Insert data into the database
    $insertQuery = "INSERT INTO student (name, roll, department, mobile, college, email, password) VALUES ('$name', '$roll', '$department', '$mobile', '$college', '$email', '$password')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
    header("Location: login.html");
// or die();
exit();
}
?>