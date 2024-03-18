<?php
// actual timer 12 hours
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Set to true for testing, false for production
  $testing = false;

  // Check if the user has posted a message in the last 12 hours
  if (isset($_COOKIE['last_message_time'])) {
    $time_difference = time() - $_COOKIE['last_message_time'];
    $time_limit = $testing ? 1 * 60 : 12 * 60 * 60; // 1 minute for testing, 12 hours for production
    if ($time_difference < $time_limit) {
      $time_left = $time_limit - $time_difference;
      setcookie('message_countdown', $time_left, time() + $time_limit, "/"); 
      header("Location: index.php");
      exit();
    }
  }


  $jsonData = file_get_contents("jsondata.json");
  $data = json_decode($jsonData, true);

  $name = $_POST["name"];
  $message = $_POST["message"];
  $uploadTime = date("Y-m-d  H:i"); // get the current date and time

  $data[] = (
    [
      "name" => $name,
      "message"=> $message,
      "image"=> $target_file,
      "uploadTime" => $uploadTime
    ]
  );

  $json = json_encode($data, JSON_PRETTY_PRINT);

  file_put_contents("jsondata.json", $json);

  // Set a cookie with the current time
  setcookie('last_message_time', time(), time() + (60), "/");

  header("Location: index.php");
}