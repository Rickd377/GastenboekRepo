<?php
session_start();

if (isset($_SESSION["messageSent"]) && $_SESSION["messageSent"] == true) {
  header("location: index.php?message=alreadySent");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if(isset($_FILES['image'])){  // Check if file was uploaded
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_name_parts = explode('.', $_FILES['image']['name']);  // Split the file name by '.'
    $file_ext = strtolower(end($file_name_parts));  // Get the extension of the uploaded file
      
    $extensions= array("jpeg","jpg","png");  // Define the allowed extensions
      
    if(in_array($file_ext,$extensions)=== false){  // Check if the file extension is allowed
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
      
    if(empty($errors)==true){  // Check if there are no errors
        $target_file = "uploads/".$file_name;
        move_uploaded_file($file_tmp,$target_file);  // Move the uploaded file to the target location
        echo "Success";
    }else{
        print_r($errors);  // Print any errors
    }
  }

  $jsonData = file_get_contents("jsondata.json");
  $data = json_decode($jsonData, true);  // Decode the JSON data into an associative array

  $name = $_POST["name"];
  $message = $_POST["message"];
  $uploadTime = date("Y-m-d  H:i");

  $data[] = (  // Add the new message to the data array
    [
      "name" => $name,
      "message"=> $message,
      "image"=> $target_file,
      "uploadTime" => $uploadTime
    ]
  );

  $json = json_encode($data, JSON_PRETTY_PRINT);  // Encode the data array back into a JSON string

  file_put_contents("jsondata.json", $json);  // Write the JSON string back to the file

  $_SESSION["messageSent"] = true;  // Set the session variable to true

  header("Location: index.php");  // Redirect the user to the index page
}
?>