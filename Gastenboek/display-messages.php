<?php
$jsonData = file_get_contents("jsondata.json");
$data = json_decode($jsonData, true);
echo "<div id='message-container'>";
$data = array_reverse($data);
foreach ($data as $key => $entry) {
    echo "<div class='message'>";
    echo "<div class='text-content'>";
    echo "<h2>" . $entry["name"] . "</h2>";
    echo "<p class='textmessage'>" . $entry["message"] . "</p>";
    if (isset($entry["uploadTime"])) { // check if the upload time exists
        echo "<p class='date'>" . $entry["uploadTime"] . "</p>"; // display the upload time
    }
    echo "</div>";
    if (isset($entry["image"]) && $entry["image"] != 'uploads/') {
        echo "<img class='uploadedimg' src='" . $entry["image"] . "'>";
    }
    echo "</div>";
}
echo "</div>";

?>