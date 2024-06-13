<?php
session_start();

// Перевірка ролі користувача
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Отримання даних з форми
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Оновлення товару
$sql = "UPDATE products SET name=?, description=?, price=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $name, $description, $price, $id);

if ($stmt->execute()) {
    // Якщо зображення було завантажено, обробляємо його
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($id . '.' . $imageFileType);

        // Переміщення завантаженого файлу до каталогу завантажень
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Оновлення шляху до зображення в базі даних
            $updateImageSql = "UPDATE products SET image_url=? WHERE id=?";
            $updateImageStmt = $conn->prepare($updateImageSql);
            $updateImageStmt->bind_param("si", $target_file, $id);
            $updateImageStmt->execute();
        }
    }
    header("Location: admin.php");
} else {
    echo "Error updating product: " . $conn->error;
}

$conn->close();
?>
