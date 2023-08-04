<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Define the correct answers here
  // Start the session to access the stored $id value
session_start();

// Get the stored $id value from the session
$id = $_SESSION['id'];

  $correctAnswers = array(
    'q1' => 'Domain Name System',
    'q2' => 'Network Layer',
    'q3' => '10 Gbps',
  );

  $userAnswers = $_POST;

  $score = 0;
  foreach ($correctAnswers as $question => $correctAnswer) {
    if (isset($userAnswers[$question]) && $userAnswers[$question] === $correctAnswer) {
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
$sql = "UPDATE student SET cn='$score' WHERE roll='$id' ";
if(mysqli_query($conn,$sql))
{
    echo "inserted";
}
else
{
    echo mysqli_error($conn);
}
$sql1="UPDATE student SET total=os+cn+dbms WHERE roll='$id' ";
mysqli_query($conn,$sql1);
header('Location: end.html');
// or die();
exit();
}
?>
