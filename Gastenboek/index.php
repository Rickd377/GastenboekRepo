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
                <p>Choose file</p>
            </label>
            <input type="submit" value="Upload" name="submit" style="font-size: 15px;">
            <!-- actual code timer 12hours -->
            <?php
            // Set to true for testing, false for production
            $testing = true;

            if (isset ($_COOKIE['message_countdown'])) {
                $countdown = $_COOKIE['message_countdown'];
                if ($testing) {
                    // If testing, set countdown to 1 minute
                    $countdown = 60;
                }
                echo "<div id='message-countdown'>You can send a message again in: <span id='timer'></span></div>";
                ?>
                <script>
                    // Set the countdown time
                    var countdown = <?php echo $countdown; ?>;

                    // Update the countdown every 1 second
                    var x = setInterval(function () {

                        // Calculate the hours, minutes and seconds
                        var hours = Math.floor(countdown / 3600);
                        var minutes = Math.floor((countdown % 3600) / 60);
                        var seconds = Math.floor(countdown % 60);

                        // Display the countdown
                        document.getElementById('timer').innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

                        // Decrease the countdown by 1
                        countdown--;

                        // If the countdown is finished, write some text 
                        if (countdown < 0) {
                            clearInterval(x);
                            document.getElementById('timer').innerHTML = "You can send a message now!";
                        }
                    }, 1000);
                </script>
                <?php
            }
            ?>
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