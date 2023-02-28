<?php
if(empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  error_log('Error: Invalid form data');
  echo json_encode(array("status" => "error"));
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$servername = "192.168.150.213";
$username = "webprogss211";
$password = "fancyR!ce36";
$dbname = "webprogss211";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  error_log('Error: Connection failed - ' . $conn->connect_error);
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO jdgonzales2_myguests(ANSname, ANSsubject, email, ANSmessage)
VALUES ('$name', '$subject', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
  echo json_encode(array("status" => "success"));
} else {
  error_log('Error: ' . $sql . ' - ' . $conn->error);
  echo json_encode(array("status" => "error"));
}

$conn->close();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
