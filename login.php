<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        echo "Будь ласка, заповніть усі поля";
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: profile.php");
                }
                exit();
            } else {
                echo "Некоректний пароль";
            }
        } else {
            echo "Користувача не знайдено";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="login_style.css">
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body class="body">
    <div class="login-page">
        <div class="form">
            <form method="post" action="">
                <input type="text" placeholder="&#xf007;  Name" name="username" required/>
                <input type="password" id="password" placeholder="&#xf023;  Password" name="password" required/>
                <i class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                <br>
                <br>
                <button type="submit">LOGIN</button>
            </form>
            <p class="message"></p>
            <form class="login-form">
                <button type="button" onclick="window.location.href='signup.php'">SIGN UP</button>
            </form>
            <form class="back">
                <button type="button" onclick="window.location.href='index.php'">BACK</button>
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
