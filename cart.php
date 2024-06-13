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

// Перевірка ролі користувача
$userRole = null;
$userId = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $roleCheckSql = "SELECT id, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($roleCheckSql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $roleCheckResult = $stmt->get_result();
    if ($roleCheckResult->num_rows > 0) {
        $row = $roleCheckResult->fetch_assoc();
        $userRole = $row['role'];
        $userId = $row['id'];
    }
    $stmt->close();
}

// Отримання товарів з кошика
$productsInCart = [];
$totalPrice = 0;
if ($userId) {
    $sql = "SELECT products.id, products.name, products.description, products.price, products.image_url, cart.quantity 
            FROM cart 
            JOIN products ON cart.product_id = products.id 
            WHERE cart.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productsInCart[] = $row;
            $totalPrice += $row['price'] * $row['quantity'];
        }
    } else {
        echo "No products found in the cart.";
    }
    $stmt->close();
} else {
    echo "User ID not found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="btn.css">
    <link rel="stylesheet" href="Market.css">
    <title>Computer Repair</title>
    <style>
        .main-window {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .product-list .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th,
        .products-table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .products-table th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
        }

        .products-table td {
            text-align: center;
        }

        .products-table img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .products-table button {
            padding: 10px 15px;
            margin: 5px;
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .products-table button.buy {
            background-color: #28a745;
        }

        .products-table button.buy:hover {
            background-color: #218838;
        }

        .products-table button.remove:hover {
            background-color: #ff1a1a;
        }

        @media (max-width: 768px) {
            .products-table th,
            .products-table td {
                padding: 10px;
            }
        }

        .nav_link.active {
            font-weight: bold;
            color: #007bff;
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
    </header>

    <main class="main-window">
        <div class="product-list">
            <div class="container">
                <h1>Your Cart</h1>
                <table class="products-table">
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                    <?php if (!empty($productsInCart)): ?>
                        <?php foreach ($productsInCart as $product): ?>
                            <tr>
                                <td><img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100"></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['price']); ?>₴</td>
                                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($product['price'] * $product['quantity']); ?>₴</td>
                                <td>
                                    <button class="remove" onclick="removeFromCart(<?php echo $product['id']; ?>)">Remove</button>
                                    <button class="buy" onclick="buyNow(<?php echo $product['id']; ?>)">Buy</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" style="text-align:right;"><strong>Total Price:</strong></td>
                            <td colspan="2"><strong><?php echo $totalPrice; ?>₴</strong></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer_box">
            <div class="footer_groups">
                <div class="footer_title" data-key="rightsReserved">© 2023 All rights reserved
                </div>
                <div class="footer_group">
                    <a href="https://www.facebook.com/profile.php?id=100013973584854" class="footer_link">
                        <img src="img/facebook 1.svg" alt="facebook">
                    </a>
                    <a href="https://www.instagram.com/bret2003fed/" class="footer_link">
                        <img src="img/instagram (1) 1.svg" alt="instagram">
                    </a>
                    <a href="" class="footer_link">
                        <img src="img/free-icon-telegram-logo-87413.svg" alt="telegram">
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    function removeFromCart(productId) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product removed from cart!');
                location.reload();
            } else {
                alert('Failed to remove product from cart. ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function buyNow(productId) {
        fetch('buy_now.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product purchased successfully!');
                location.reload();
            } else {
                alert('Failed to purchase product. ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

</body>

</html>
