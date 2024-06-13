<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products
$sql = "SELECT id, name, description, price, image_url FROM products";
$result = $conn->query($sql);

// Handle product deletion
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    $deleteSql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $idToDelete);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Handle product update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $updateSql = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssdi", $name, $description, $price, $id);
    $stmt->execute();

    // Handle image update
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($id . '.' . $imageFileType);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $updateImageSql = "UPDATE products SET image_url = ? WHERE id = ?";
            $updateImageStmt = $conn->prepare($updateImageSql);
            $updateImageStmt->bind_param("si", $target_file, $id);
            $updateImageStmt->execute();
        }
    }
    header("Location: admin.php");
    exit();
}

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $addSql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($addSql);
    $stmt->bind_param("ssd", $name, $description, $price);
    $stmt->execute();
    $productId = $stmt->insert_id;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($productId . '.' . $imageFileType);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $updateImageSql = "UPDATE products SET image_url = ? WHERE id = ?";
            $updateImageStmt = $conn->prepare($updateImageSql);
            $updateImageStmt->bind_param("si", $target_file, $productId);
            $updateImageStmt->execute();
        }
    }
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="btn.css">
	<link rel="stylesheet" href="feedback.css">
	<link rel="icon" href="img/logo.jpg" type="image/x-icon">
	<link rel="stylesheet" href="focus.css">
	<link rel="button-close" href="button-close.css">
	<script src="login-regista.js"> </script>
	<script src="login.js" defer></script>
	<script src="profile.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
          table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    .action-buttons button {
        padding: 5px 10px;
    }
    .add-product-form {
        
    background-color: #f8f9fa; /* колір фону */
    padding: 20px; /* внутрішні відступи */
    border-radius: 10px; /* закруглені кути */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* тінь */
    border: 2px solid #007bff; /* колір межі */
    float: left; /* вирівнювання з правого боку */
    margin-top: 20px; /* відступ зверху */
    margin-bottom: 20px; /* відступ знизу */
}
.add-product-form h2 {
    margin-bottom: 20px; /* відступ від заголовка до форми */
}
    .add-product-form label {
        display: block;
        margin: 5px 0 5px;
    }
    .add-product-form input[type="text"],
    .add-product-form textarea,
    .add-product-form input[type="file"] {
        width: 97%;
        padding: 5px;
        margin-bottom: 2px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .add-product-form input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .add-product-form input[type="submit"]:hover {
        background-color: #0056b3;
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
                <div class="nav_languages">
                    <a href="#" class="nav_en">EN</a>
                    <a href="#" class="nav_ua">UA</a>
                </div>
                <?php if (isset($_SESSION['username'])): ?>
					<a href="logout.php" class="button" id="logout-button">Logout</a>
				<?php else: ?>
					<a href="login.php" class="button" id="login-button">Login</a>
				<?php endif; ?>
            </div>
        </nav>
    </header>
    <main>
        
        

        <div class="add-product-form">
        <h2>Додати новий продукт</h2>

        <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br><br>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required><br><br>
        
        <input type="submit" value="Add Product">
    </form>
  
    </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var addProductForm = document.getElementById('addProductForm');
                addProductForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    var productName = addProductForm.productName.value;
                    var productDescription = addProductForm.productDescription.value;
                    var productPrice = addProductForm.productPrice.value;
                    addProductForm.reset();
                    var storedProducts = JSON.parse(localStorage.getItem('products')) || [];
                    storedProducts.push({
                        name: productName,
                        description: productDescription,
                        price: productPrice
                    });
                    localStorage.setItem('products', JSON.stringify(storedProducts));
                });
            });
        </script>
        
        <table>
            <thead>
                <tr>
                    <th>id </th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["price"]) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row["image_url"]) . "' alt='" . htmlspecialchars($row["name"]) . "' width='50'></td>";
                        echo "<td class='action-buttons'>";
                        echo "<a href='edit_product.php?id=" . htmlspecialchars($row["id"]) . "'>Edit</a> | ";
                        echo "<a href='admin.php?delete=" . htmlspecialchars($row["id"]) . "'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

       
        <h1>Заявки</h1>
        <table>
            <thead>
                <tr>
                    <th>Послуга</th>
                    <th>Ім'я</th>
                    <th>Email</th>
                    <th>Деталі</th>
                    <th>Телефон</th>
                    <th>Адреса</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody id="formDataTable">
                <!-- Data will be loaded here -->
            </tbody>
        </table>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var storedData = JSON.parse(localStorage.getItem('formData')) || [];
                var tableBody = document.getElementById('formDataTable');

                function renderTable() {
                    tableBody.innerHTML = '';
                    storedData.forEach(function(data, index) {
                        var row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${data.service}</td>
                            <td>${data.name}</td>
                            <td>${data.email}</td>
                            <td>${data.details}</td>
                            <td>${data.phone}</td>
                            <td>${data.address}</td>
                            <td class="action-buttons">
                                <button onclick="editData(${index})">Редагувати</button>
                                <button onclick="deleteData(${index})">Видалити</button>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }

                window.editData = function(index) {
                    var data = storedData[index];
                    var form = document.createElement('form');
                    form.innerHTML = `
                        <label>Послуга</label>
                        <input type="text" name="service" value="${data.service}">
                        <label>Ім'я</label>
                        <input type="text" name="name" value="${data.name}">
                        <label>Email</label>
                        <input type="email" name="email" value="${data.email}">
                        <label>Деталі</label>
                        <textarea name="details">${data.details}</textarea>
                        <label>Телефон</label>
                        <input type="text" name="phone" value="${data.phone}">
                        <label>Адреса</label>
                        <input type="text" name="address" value="${data.address}">
                        <button type="submit">Зберегти</button>
                    `;
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        var updatedData = {
                            service: form.service.value,
                            name: form.name.value,
                            email: form.email.value,
                            details: form.details.value,
                            phone: form.phone.value,
                            address: form.address.value
                        };
                        storedData[index] = updatedData;
                        localStorage.setItem('formData', JSON.stringify(storedData));
                        renderTable();
                    });
                    tableBody.innerHTML = '';
                    tableBody.appendChild(form);
                };

                window.deleteData = function(index) {
                    storedData.splice(index, 1);
                    localStorage.setItem('formData', JSON.stringify(storedData));
                    renderTable();
                };

                renderTable();
            });
        </script>
    </main>
</body>
</html>
<?php
$conn->close();
?>