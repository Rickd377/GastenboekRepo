<?php
    if (isset($_GET["message"])) {
        echo "<script>alert('Message already sent!');</script>";
    } 
?>

<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body>
    <div id="container">
        <form action="upload-data.php" method="POST" enctype="multipart/form-data">
            <h3>Name</h3>
            <input type="text" name="name" placeholder="Enter your name..." autocomplete="off">
            <br>
            <h3>Message</h3>
            <textarea class="messageinput" name="message" maxlength="500" placeholder="Enter your message here..."
                autocomplete="off"></textarea>
            <br>
            <input type="file" id="image" name="image">
            <label for="image" id="file-label"><i class="fa-solid fa-image"></i>
                <p>Choose An Image</p>
            </label>
            <input type="submit" value="Upload" name="submit" style="font-size: 15px;">
        </form>
        <?php include "display-messages.php"; ?>
    </div>

    <script>
        document.getElementById('image').addEventListener('change', function () {
            var fileName = this.files[0].name;
            if (fileName.length > 25) {
                fileName = fileName.substring(0, 25) + " ...";
            }
            document.getElementById('file-label').textContent = fileName;
        });

        window.addEventListener('load', function () {
            var container = document.getElementById('message-container');
            container.scrollTop = 0;
        });
    </script>
    <script src="https://kit.fontawesome.com/29186d169c.js" crossorigin="anonymous"></script>
</body>

</html>