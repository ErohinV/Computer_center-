
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("З'єднання не вдалося: " . $conn->connect_error);
}
?>
