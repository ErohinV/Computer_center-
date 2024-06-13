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

// Перевірка чи користувач авторизований
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Отримання сповіщень про покупку
$purchaseNotifications = [];
$sql = "SELECT products.name AS product_name, 'purchased' AS notification_type, orders.purchase_date 
        FROM orders 
        JOIN products ON orders.product_id = products.id 
        JOIN users ON orders.user_id = users.id 
        WHERE users.username = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $purchaseNotifications[] = $row;
    }
    $stmt->close();
}

// Отримання сповіщень про видалення товару з корзини
$deleteNotifications = [];
$sql = "SELECT products.name AS product_name, 'removed from cart' AS notification_type, cart.removal_date 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        JOIN users ON cart.user_id = users.id 
        WHERE users.username = ?";
$stmt = $conn->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $deleteNotifications[] = $row;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Notifications</title>
    <style>
        /* main.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f1f3f4;
}

header {
    background-color: #202124;
    color: #e8eaed;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    margin: 0;
    font-size: 24px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    color: #e8eaed;
    text-decoration: none;
    font-size: 16px;
}

nav ul li a:hover {
    text-decoration: underline;
}

main {
    padding: 20px;
}

main h2 {
    color: #202124;
    font-size: 20px;
    margin-bottom: 10px;
}

section {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    box-shadow: 0 1px 3px rgba(60, 64, 67, 0.3), 0 1px 2px rgba(60, 64, 67, 0.15);
}

section ul {
    list-style-type: none;
    padding: 0;
}

section ul li {
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
}

section ul li:last-child {
    border-bottom: none;
}

footer {
    background-color: #202124;
    color: #e8eaed;
    text-align: center;
    padding: 10px 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
}

.footer_margin {
    display: flex;
    justify-content: space-between;
}

.footer_margin .left a,
.footer_margin .right a {
    color: #e8eaed;
    margin: 0 5px;
    text-decoration: none;
}

.footer_margin .left a:hover,
.footer_margin .right a:hover {
    text-decoration: underline;
}

.footer_margin img {
    width: 20px;
    height: 20px;
}

        </style>
</head>

<body>
    <header>
        <h1>Notifications</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Purchase Notifications</h2>
            <ul>
                <?php if (empty($purchaseNotifications)): ?>
                    <li>No purchase notifications found.</li>
                <?php else: ?>
                    <?php foreach ($purchaseNotifications as $notification): ?>
                        <li>
                            <span><?php echo htmlspecialchars($notification['product_name']); ?> was <?php echo htmlspecialchars($notification['notification_type']); ?></span>
                            <span><?php echo date("Y-m-d H:i:s", strtotime($notification['purchase_date'])); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </section>

        <section>
            <h2>Deleted from Cart Notifications</h2>
            <ul>
                <?php if (empty($deleteNotifications)): ?>
                    <li>No delete notifications found.</li>
                <?php else: ?>
                    <?php foreach ($deleteNotifications as $notification): ?>
                        <li>
                            <span><?php echo htmlspecialchars($notification['product_name']); ?> was <?php echo htmlspecialchars($notification['notification_type']); ?></span>
                            <span><?php echo date("Y-m-d H:i:s", strtotime($notification['removal_date'])); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </section>
    </main>

    <footer class="footer">
        <div class="footer_margin">
            <div class="left">
                <a href="https://instagram.com"><img src="img/instagram.svg" alt="Instagram"></a>
                <a href="https://linkedin.com"><img src="img/in.svg" alt="LinkedIn"></a>
                <a href="https://twitter.com"><img src="img/twitter.svg" alt="Twitter"></a>
            </div>
            <div class="right">
                <a href="https://ukraine.com"><img src="img/flag.svg" alt="Ukraine"></a>
                <a href="mailto:support@gmail.com"><img src="img/mail.svg" alt="Email"></a>
                <a href="tel:+380111111111"><img src="img/phone.svg" alt="Phone"></a>
            </div>
        </div>
    </footer>
</body>

</html>
