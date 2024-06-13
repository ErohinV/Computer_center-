<?php
session_start();

// Перевірка, чи було відправлено зображення
if (isset($_FILES['profile_image'])) {
    // Отримання бінарних даних зображення
    $profileImageData = file_get_contents($_FILES['profile_image']['tmp_name']);

    // Отримання інших даних користувача (ім'я, email і т.д.)
    // Ви можете отримати ці дані з сесії або з форми, якщо вони були відправлені разом з зображенням
    $userName = $_SESSION['username'];
    $userEmail = $_SESSION['email'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Computer_center";

    // Створення з'єднання
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Перевірка з'єднання
    if ($conn->connect_error) {
        die("Помилка підключення до бази даних: " . $conn->connect_error);
    }

    // Підготовлений SQL-запит для вставки зображення в базу даних
    $stmt = $conn->prepare("INSERT INTO users (username, email, profile_image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userName, $userEmail, $profileImageData);

    // Виконати запит
    if ($stmt->execute()) {
        echo "Зображення успішно додано до бази даних.";
    } else {
        echo "Помилка при додаванні зображення до бази даних: " . $conn->error;
    }

    // Закриття з'єднання
    $stmt->close();
    $conn->close();
} else {
    echo "Помилка: зображення не було завантажено.";
}
?>
