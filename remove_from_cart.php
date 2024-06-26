<?php
session_start();

header('Content-Type: application/json');

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримати дані з POST запиту
    $data = json_decode(file_get_contents('php://input'), true);
    $productId = $data['product_id'];

    // Переконатися, що сесія активна і отримати userId
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $roleCheckSql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($roleCheckSql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $roleCheckResult = $stmt->get_result();
        if ($roleCheckResult->num_rows > 0) {
            $row = $roleCheckResult->fetch_assoc();
            $userId = $row['id'];
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found.']);
            $stmt->close();
            $conn->close();
            exit();
        }
        $stmt->close();

        // Видалити товар з корзини
        $deleteCartSql = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($deleteCartSql);
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $stmt->close();

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
