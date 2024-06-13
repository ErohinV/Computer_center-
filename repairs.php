<?php
session_start();

// Підключення до бази даних
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Відстеження статусу ремонту</title>
    <style>
        .container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #4CAF50;
}

form {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

label {
    margin-bottom: 5px;
}

input[type="text"] {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    padding: 10px;
    background-color: #4CAF50;
    border: none;
    border-radius: 4px;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4CAF50;
    color: white;
}
        </style>
</head>
<body>
<header class="header">
        <nav class="header_nav">
            <div class="nav_margin">
                <p class="logo">c<span> o </span>mp</p>
                <div class="nav_links">
                <a href="index.php" class="nav_link en" data-key="Main">Main</a>
                    <a href="Our services.php" class="nav_link en" data-key="services">Our services</a>
                    <a href="About.php" class="nav_link en" data-key="about">About</a>
                    <a href="Contacts.php" class="nav_link en" data-key="contacts">Contacts</a>
                    <a href="Market.php" class="nav_link en" data-key="catalog">Сatalog</a>
                </div>


                <script>
document.addEventListener("DOMContentLoaded", function() {
            // Get the current path
            const path = window.location.pathname.split("/").pop();

            // Get all nav links
            const navLinks = document.querySelectorAll(".nav_links .nav_link");

            // Loop through the nav links and add the 'active' class to the matching link
            navLinks.forEach(link => {
                if (link.getAttribute("href") === path) {
                    link.classList.add("active");
                }
            });
        });
                    </script>

                <div class="nav_languages">
                    <a href="#" class="nav_en">EN</a>
                    <a href="#" class="nav_ua">UA</a>
                </div>
                <?php if (isset($_SESSION['username'])): ?>
					<a href="profile.php" class="button" id="user-button"><?php echo $_SESSION['username']; ?></a>
				<?php else: ?>
					<a href="login.php" class="button" id="login-button">Login</a>
				<?php endif; ?>
            </div>
        </nav>


        <!-- Burger -->

        <div class="menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="menu" id="menu">

            <div class="user-icon">
                <img src="img/user.svg" alt="">
                <hr>
                <span> User Defold </span> 
            </div>
            <hr>
            <nav>
                <ul>
                    <li><a href="index.php" data-key="main">Main</a></li>
                    <li><a href="Our services.php" data-key="services">Our services</a></li>
                    <li><a href="About.php" data-key="about">About</a></li>
                    <li><a href="Contacts.php" data-key="contacts">Contacts</a></li>
                    <li><a href="Reviews.php" data-key="reviews">Reviews</a></li>
                    <li><a href="Market.php" data-key="market">Market</a></li>
                </ul>
            </nav>
            <hr>
            <div class="menu-options">
                <ul>
                    <li><a href="#" data-key="catalog">Catalog</a></li>
                    <li><a href="#" data-key="helpCenter">Help Center</a></li>
                    <li><a href="#" data-key="chat">Chat</a></li>
                    <li><a href="#" data-key="category">Category</a></li>

                </ul>
            </div>
            <hr>
            <div class="user-actions">
                <ul>
                    <li><a href="#" data-key="myOrders">My Orders</a></li>
                    <li><a href="#" data-key="cart">Cart</a></li>
                    <li><a href="#" data-key="personalizedOffers">Personalized Offers</a></li>
                    <li><a href="#" data-key="wishlists">Wishlists</a></li>

                </ul>
            </div>
        </div>

    <div class="container">
        <h1>Відстеження статусу ремонту</h1>
        <form method="POST" action="">
            <label for="client_code">Код клієнта:</label>
            <input type="text" id="client_code" name="client_code" required>
            <input type="submit" value="Перевірити статус">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client_code = $_POST['client_code'];

            // Запит до бази даних для отримання статусу ремонту
            $sql = "SELECT * FROM repairs WHERE client_code = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $client_code);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>ID клієнта</th>
                            <th>Email</th>
                            <th>Ім'я користувача</th>
                            <th>Пароль</th>
                            <th>Роль</th>
                            <th>Код клієнта</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td>{$row['role']}</td>
                            <td>{$row['client_code']}</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Ремонт для клієнта з кодом {$client_code} не знайдено.</p>";
            }

            $stmt->close();
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
