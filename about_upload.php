<?php

class CaptionManager {
    private $conn;
    private $message = "";
    public function __construct($hostname, $username, $password, $database) {
        $this->conn = mysqli_connect($hostname, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function processCaptionSubmission() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caption1 = $this->conn->real_escape_string($_POST["caption1"]);
            $caption2 = $this->conn->real_escape_string($_POST["caption2"]);
            $caption3 = $this->conn->real_escape_string($_POST["caption3"]);
            $caption4 = $this->conn->real_escape_string($_POST["caption4"]);
            $caption5 = $this->conn->real_escape_string($_POST["caption5"]);

            $this->deleteExistingCaptions($caption1, $caption2, $caption3, $caption4, $caption5);

            $sql = "INSERT INTO about (caption1, caption2, caption3, caption4, caption5) VALUES ('$caption1', '$caption2', '$caption3', '$caption4', '$caption5')";

            if ($this->conn->query($sql) === TRUE) {
                $this->message = "Caption successfully submitted!";
                header("refresh:2;url=about_admin.php");
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }
    private function deleteExistingCaptions($caption1, $caption2, $caption3, $caption4, $caption5) {
        $deleteQuery = "DELETE FROM about WHERE caption1 = '$caption1' OR caption2 = '$caption2' OR caption3 = '$caption3' OR caption4 = '$caption4' OR caption5 = '$caption5'";
        $this->conn->query($deleteQuery);
    }

    public function showMessage() {
        return $this->message;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$captionManager = new CaptionManager('localhost', 'root', '', 'cart_db');
$captionManager->processCaptionSubmission();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: black;
            color: white;
        }

        .message-container {
            padding: 30px;
            background-color: black;
            border: 2px solid white;
            border-radius: 10px;
            font-size: 35px;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php echo $captionManager->showMessage(); ?>
    </div>
</body>
</html>

<?php
$captionManager->closeConnection();
?>
