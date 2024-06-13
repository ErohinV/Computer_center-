<?php
// Подключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

// Обробка даних форми при POST запиті
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Перевірка чи введені дані не порожні
    if (empty($email) || empty($username) || empty($password)) {
        echo "Будь ласка, заповніть усі поля";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Перевірка коректності адреси електронної пошти
        echo "Некоректна адреса електронної пошти";
    } else {
        // Шифрування пароля
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Підготовка та виконання SQL-запиту
        $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $username, $hashed_password);

        if ($stmt->execute()) {
            // Перенаправлення на сторінку login.php після успішної реєстрації
            header("Location: login.php");
            exit();
        } else {
            echo "Помилка: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="signup_style.css" />
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body class="body">
    <div class="login-page">
        <div class="form">
            <form method="post" action="">
                <input type="text" placeholder="Gmail" name="email" required/>
                <input type="text" placeholder="Name" name="username" required/>
                <input type="password" id="password" placeholder="Set a password" name="password" required/>
                <i class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                <br>
                <br>
                <button type="submit">SIGN UP</button>

      <button type="button" onclick="window.location.href='login.php'">BACK</button>

            </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
</body>
</html>
