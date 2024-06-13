<?php
// Перевірка, чи була відправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    // Шлях до файлу з відгуками
    $file = 'feedback.txt';
    
    // Перевірка існування файлу
    if (!file_exists($file)) {
        // Створення файлу, якщо він не існує
        fopen($file, 'w');
    }
    
    // Запис даних у файл
    $current = file_get_contents($file);
    $current .= "Name: $name\nEmail: $email\nMessage: $message\n\n";
    file_put_contents($file, $current);
    
    // Відправка повідомлення про успішне відправлення відгуку
    echo "Thank you for your feedback!";
} else {
    // Якщо форма не була відправлена, перенаправте користувача на сторінку з формою
    header("Location: feedback_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>
<body>
    <button href="index.php">Back</button>
</body>
</html>