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

// Отримання товарів з бази даних з урахуванням фільтрів
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
$cpu = isset($_GET['cpu']) ? $_GET['cpu'] : '';
$memory = isset($_GET['memory']) ? $_GET['memory'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 12;
$offset = ($page - 1) * $limit;

$sql = "SELECT id, name, description, price, image_url FROM products WHERE 1=1";

if (!empty($cpu)) {
    $sql .= " AND description LIKE '%" . $conn->real_escape_string($cpu) . "%'";
}

if (!empty($memory)) {
    $sql .= " AND description LIKE '%" . $conn->real_escape_string($memory) . "%'";
}

if (!empty($search)) {
    $sql .= " AND name LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$sql .= " ORDER BY price " . ($order === 'desc' ? 'DESC' : 'ASC');
$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Отримати загальну кількість товарів для пагінації
$countSql = "SELECT COUNT(*) as total FROM products WHERE 1=1";

if (!empty($cpu)) {
    $countSql .= " AND description LIKE '%" . $conn->real_escape_string($cpu) . "%'";
}

if (!empty($memory)) {
    $countSql .= " AND description LIKE '%" . $conn->real_escape_string($memory) . "%'";
}

if (!empty($search)) {
    $countSql .= " AND name LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$countResult = $conn->query($countSql);
$totalProducts = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $limit);

// Перевірка ролі користувача
$userRole = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $roleCheckSql = "SELECT role FROM users WHERE username = '$username'";
    $roleCheckResult = $conn->query($roleCheckSql);
    if ($roleCheckResult->num_rows > 0) {
        $row = $roleCheckResult->fetch_assoc();
        $userRole = $row['role'];
    }
}
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
        .filter {
            width: 200px;
            float: left;
            margin-top: 18px;
            margin-right: 4px;
            padding: 24px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .filter label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.filter select {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}
        .products {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.product {
    position: relative;
    width: 300px;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.product img {
    width: 100%;
    height: auto;
}

h2, .price {
    margin: 10px 0;
}

.product h2 {
    font-size: 1.2em;
    margin: 10px 0;
}


.product .description {
    height: 3em; /* Approx. 2 lines of text */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    transition: height 0.5s ease;
}

.product:hover .description {
    height: auto;
    -webkit-line-clamp: unset;
    white-space: normal;
}

.product p {
    margin: 5px 0;
}

.product:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

        .search-bar {
           
            width: 100%;
            text-align: center;
            margin-bottom: 2px;
        }

        .search-bar form {
            display: inline-block;
        }

        .search-bar input {
            width: 925px;
            padding: 14px;
            font-size: 16px;
            border: 5px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #45a049;
        }

        /* Стилі для модального вікна */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 10px;
        }

        .modal-content img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .modal-header,
        .modal-footer {
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }

        .modal-footer {
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .modal-footer button {
            margin-top: 10px;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        .modal-footer button:hover {
            background-color: #0056b3;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        

.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    margin: 0 5px;
    padding: 10px 15px;
    text-decoration: none;
    border: 1px solid #ddd;
    color: #333;
    background-color: #f9f9f9;
    border-radius: 4px;
}

.pagination a.active {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination a:hover {
    background-color: #ddd;
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

        <!-- Burger Menu -->
        <div class="menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="menu" id="menu">
            <div class="user-icon">
                <img src="img/user.svg" alt="">
                <hr>
                <span>User</span> 
            </div>
            <hr>
            <nav>
                <ul>
                    <li><a href="index.php">Main</a></li>
                    <li><a href="Our services.php">Our services</a></li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="Contacts.php">Contacts</a></li>
                    <li><a href="Reviews.php">Reviews</a></li>
                </ul>
            </nav>
            <hr>
            <div class="menu-options">
                <ul>
                    <li><a href="Market.php">Catalog</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Chat</a></li>
                    <li><a href="#">Category</a></li>
                </ul>
            </div>
            <hr>
            <div class="user-actions">
                <ul>
                    <li><a href="#">My Orders</a></li>
                    <li><a href="#">Cart</a></li>
                    <li><a href="#">Personalized Offers</a></li>
                    <li><a href="#">Wishlists</a></li>
                </ul>
            </div>
        </div>

   
      
                
        <div class="header_box ">
            <div class="header_margin">
                <div class="header_title" data-key="title">
                
                </div>
            
            </div>

        </div>
        <script>
            const images = [
    'img/header.jpg',
    'img/header2.jpg',
    'img/header3.jpg' 
];
let currentIndex = 0;

function changeBackground() {
    const headerBox = document.querySelector('.header_box');
    currentIndex = (currentIndex + 1) % images.length;
    headerBox.style.backgroundImage = `url(${images[currentIndex]})`;
}

setInterval(changeBackground, 5000); // змінює зображення кожні 5 секунд
        </script>

    </header>


    
    <main class="main">
    <div class="main-window">
        <div class="container">
            
            <div class="filter">
    <form method="GET" action="Market.php" class="filter-form">
        <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        
        <label for="order">Sort by price:</label>
        <select name="order" id="order" onchange="this.form.submit()">
            <option value="asc" <?php if (isset($_GET['order']) && $_GET['order'] == 'asc') echo 'selected'; ?>>Ascending</option>
            <option value="desc" <?php if (isset($_GET['order']) && $_GET['order'] == 'desc') echo 'selected'; ?>>Descending</option>
        </select>
        
        <label for="cpu">Processor:</label>
        <select name="cpu" id="cpu" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="AMD" <?php if (isset($_GET['cpu']) && $_GET['cpu'] == 'AMD') echo 'selected'; ?>>AMD</option>
            <option value="Intel" <?php if (isset($_GET['cpu']) && $_GET['cpu'] == 'Intel') echo 'selected'; ?>>Intel</option>
        </select>
        
        <label for="memory">Memory:</label>
        <select name="memory" id="memory" onchange="this.form.submit()">
            <option value="">All</option>
            
            <option value="DDR2" <?php if (isset($_GET['memory']) && $_GET['memory'] == 'DDR2') echo 'selected'; ?>>DDR2</option>
            <option value="DDR3" <?php if (isset($_GET['memory']) && $_GET['memory'] == 'DDR3') echo 'selected'; ?>>DDR3</option>
            <option value="DDR4" <?php if (isset($_GET['memory']) && $_GET['memory'] == 'DDR4') echo 'selected'; ?>>DDR4</option>
            <option value="DDR5" <?php if (isset($_GET['memory']) && $_GET['memory'] == 'DDR5') echo 'selected'; ?>>DDR5</option>
        </select>
    </form>
</div>

<div class="products">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" data-id="<?php echo htmlspecialchars($row['id']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>Price: <?php echo htmlspecialchars($row['price']); ?>грн</p>
                <p class="description"><?php echo htmlspecialchars($row['description']); ?></p>
                <div>
                    <?php if ($userRole === 'admin'): ?>
                        <button onclick="window.location.href='edit_product.php?id=<?php echo htmlspecialchars($row['id']); ?>'">Edit</button>
                        <button onclick="window.location.href='delete_product.php?id=<?php echo htmlspecialchars($row['id']); ?>'">Delete</button>
                    <?php else: ?>
                        <button onclick="addToCart(<?php echo htmlspecialchars($row['id']); ?>)">Add to Cart</button>
                        <button onclick="buyNow(<?php echo htmlspecialchars($row['id']); ?>)">Buy Now</button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>




   <script>
    function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added to cart!');
            } else {
                alert('Failed to add product to cart.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function buyNow(productId) {
        // Логіка для обробки покупки товару
        console.log('Product bought:', productId);
    }
</script>




 
    
</div>
</main>



    <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>&search=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>&order=<?php echo isset($_GET['order']) ? htmlspecialchars($_GET['order']) : ''; ?>">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>&order=<?php echo isset($_GET['order']) ? htmlspecialchars($_GET['order']) : ''; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>&search=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>&order=<?php echo isset($_GET['order']) ? htmlspecialchars($_GET['order']) : ''; ?>">Next</a>
                <?php endif; ?>
            </div>


<footer class="footer">
		<div class="footer_box">
			<div class="footer_groups">
				<div class="footer_title">© 2023 All rights reserved 
				</div>
				<div class="footer_group">
					<a href="" class="footer_link">
						<img src="img/linkedin 1.svg" alt="linkedin">
						<a href="https://www.facebook.com/profile.php?id=100013973584854" class="footer_link">
							<img src="img/facebook 1.svg" alt="linkedin">
						</a>
						<a href="https://www.instagram.com/bret2003fed/" class="footer_link">
							<img src="img/instagram (1) 1.svg" alt="linkedin">
						</a>
				</div>
			</div>
		</div>
	</footer>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img src="" alt="Product Image">
        <div class="product-details">
            <h2></h2>
            <p class="description"></p>
            <p class="price"></p>
        </div>
        <div class="modal-footer">
            <?php if ($userRole === 'admin'): ?>
                <button id="editProduct">Edit</button>
                <button id="deleteProduct">Delete</button>
            <?php else: ?>
                <button id="addToCart">Add to Cart</button>
                <button id="buyNow">Buy Now</button>
            <?php endif; ?>
        </div>
    </div>
</div>
            



    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("myModal");
    const modalImg = modal.querySelector("img");
    const modalTitle = modal.querySelector(".product-details h2");
    const modalDesc = modal.querySelector(".product-details .description");
    const modalPrice = modal.querySelector(".product-details .price");
    const closeModal = modal.querySelector(".close");

    document.querySelectorAll(".product img").forEach(img => {
        img.addEventListener("click", function() {
            const product = img.closest('.product');
            modal.style.display = "block";
            modalImg.src = img.src;
            modalTitle.textContent = product.querySelector("h2").textContent;
            modalDesc.textContent = product.querySelector("p:nth-of-type(1)").textContent;
            modalPrice.textContent = product.querySelector("p:nth-of-type(2)").textContent;
        });
    });

    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });

    const menuBtn = document.querySelector('.menu-btn');
    const menu = document.querySelector('.menu');
    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('active');
        menuBtn.classList.toggle('active');
    });
});
    </script>
   
     

</body>

</html>

<?php
$conn->close();
?>
