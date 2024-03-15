<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your image";
  }
}

// // Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
//   echo "Sorry, only JPG, JPEG & PNG files are allowed.";
//   $uploadOk = 0;
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $jsonData = file_get_contents("jsondata.json");

  $data = json_decode($jsonData, true);

  $name = $_POST["name"];
  $message = $_POST["message"];
  $uploadTime = date("Y-m-d H:i"); // get the current date and time

  $data[] = (
    [
      "name" => $name,
      "message"=> $message,
      "image"=> $target_file,
      "uploadTime" => $uploadTime // add the upload time to the data
    ]
  );

  $json = json_encode($data, JSON_PRETTY_PRINT);

  file_put_contents("jsondata.json", $json);

  echo '<pre>' . $json . '</pre>';
}

header("Location: index.php");