<?php

class CaptionSubmitter {
    private $conn;

    public function __construct($hostname, $username, $password, $database) {
        $this->conn = new mysqli($hostname, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function submitCaption() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $caption_id1 = $this->sanitizeInput($_POST["caption_id1"]);
            $caption_id2 = $this->sanitizeInput($_POST["caption_id2"]);

            $this->deleteExistingCaptions($caption_id1, $caption_id2);

            $sql = "INSERT INTO projekticaption (caption_id1, caption_id2) VALUES ('$caption_id1', '$caption_id2')";

            if ($this->conn->query($sql) === TRUE) {
                $this->redirectToMainAdmin();
                return "Caption successfully submitted!";
            } else {
                return "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    private function sanitizeInput($input) {
        return $this->conn->real_escape_string($input);
    }

    private function deleteExistingCaptions($caption_id1, $caption_id2) {
        $deleteQuery = "DELETE FROM projekticaption WHERE caption_id1 = '$caption_id1' OR caption_id2 = '$caption_id2'";
        $this->conn->query($deleteQuery);
    }

    private function redirectToMainAdmin() {
        header("refresh:2;url=main_admin.php");
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

$captionSubmitter = new CaptionSubmitter('localhost', 'root', '', 'cart_db');
$message = $captionSubmitter->submitCaption();
$captionSubmitter->closeConnection();

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
        <?php echo $message; ?>
    </div>
</body>
</html>
