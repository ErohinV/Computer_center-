<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productId = intval($_GET['id']);
$username = $_SESSION['username'];

$adminCheckSql = "SELECT role FROM users WHERE username = '$username'";
$adminCheckResult = $conn->query($adminCheckSql);
if ($adminCheckResult->num_rows > 0) {
    $row = $adminCheckResult->fetch_assoc();
    if ($row['role'] == 'admin') {
        $sql = "DELETE FROM products WHERE id = $productId";
        if ($conn->query($sql) === TRUE) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    } else {
        echo "You do not have permission to delete this product.";
    }
} else {
    echo "User not found.";
}

$conn->close();
?>
