<?php
// Підключення до бази даних (замініть значення згідно вашого сервера та налаштувань)
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

// Отримання даних з форми
$name = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Підготовка SQL-запиту для вставки даних
$sql = "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')";

// Виконання SQL-запиту
if ($conn->query($sql) === TRUE) {
    // Перенаправлення на сторінку profil.php
    header("Location: profil.php");
    exit(); // Важливо викликати exit() після перенаправлення, щоб гарантувати завершення виконання скрипта
} else {
    echo "Помилка: " . $sql . "<br>" . $conn->error;
}

// Закриття з'єднання
$conn->close();
?>
