<?php
// Define the correct answers
// Start the session to access the stored $id value
session_start();

// Get the stored $id value from the session
$id = $_SESSION['id'];

$correctAnswers = array(
    'q1' => 'DELETE',
    'q2' => 'MySQL',
    'q3' => 'Retrieve data',
);

// Get user's submitted answers
$userAnswers = array();
foreach ($correctAnswers as $question => $correctAnswer) {
    if (isset($_POST[$question])) {
        $userAnswers[$question] = $_POST[$question];
    }
}

// Check answers and calculate score
$score = 0;
foreach ($userAnswers as $question => $userAnswer) {
    if ($userAnswer === $correctAnswers[$question]) {
        $score++;
    }
}

// Generate the result message
$servername = "localhost";
$data_username = "root";
$data_password = "root";
$database = "Project";
$conn = new mysqli($servername, $data_username, $data_password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE student SET dbms='$score' WHERE roll='$id' ";
if(mysqli_query($conn,$sql))
{
    echo "inserted";
}
else
{
    echo mysqli_error($conn);
}
header('Location: test2.html');
// or die();
exit();
?>
