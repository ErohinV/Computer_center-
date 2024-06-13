<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Computer_center";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $lastName = htmlspecialchars($_POST['LastName']);
    $firstName = htmlspecialchars($_POST['FirstName']);
    $email = htmlspecialchars($_POST['Email']);
    $phone = htmlspecialchars($_POST['Phone']);
    $message = htmlspecialchars($_POST['Message']);

    $sql = "INSERT INTO reviews (user_id, last_name, first_name, email, phone, message) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('isssss', $user_id, $lastName, $firstName, $email, $phone, $message);
    $stmt->execute();
}

$sql = "SELECT reviews.*, users.username FROM reviews JOIN users ON reviews.user_id = users.id ORDER BY created_at DESC";
$result = $conn->query($sql);
$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}

$conn->close();
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
    <link rel="stylesheet" href="Reviews.css">
    <script src="login-regista.js"></script>
    <script src="login.js" defer></script>
    <script src="Market.js"></script>
    <script src="profile.js"></script>
    <title>Computer Repair</title>
	<style>
	.reviews {
    margin-bottom: 20px;
}

.review {
    border-bottom: 1px solid #ccc;
    padding: 10px 0;
}

.section_feedback .wrapper {
    max-width: 600px;
    margin: 0 auto;
}

.input-box {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.input-box input, .input-box textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn {
    padding: 10px 20px;
    border: none;
    background-color: #4CAF50;
    color: #fff;
    cursor: pointer;
    border-radius: 5px;
}

.btn:hover {
    background-color: #45a049;
}
		</style>
</head>

<body>
	<header class="header">
		<nav class="header_nav">
			<div class="nav_margin">
				<p class="logo">c<span> o </span>mp</p>
				<div class="nav_links">
					
					<a href="Our services.php" class="nav_link">Our services</a>
					<a href="About.php" class="nav_link">About</a>
					<a href="Contacts.php" class="nav_link">Contacts</a>
					<a href="Market.php" class="nav_link">Catalog</a>
                    <a href="Reviews.php" class="nav_link">Reviews</a>
				</div>
				<div class="nav_languages">
					<a href="#" class="nav_en">EN</a>
					<a href="#" class="nav_ua">UA</a>
				</div>
				</div>
                <?php if (isset($_SESSION['username'])): ?>
					<a href="profile.php" class="button" id="user-button"><?php echo $_SESSION['username']; ?></a>
				<?php else: ?>
					<a href="login.php" class="button" id="login-button">Login</a>
				<?php endif; ?>
            </div>
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
					<li><a href="index.php">Main</a></li>
					<li><a href="Our services.php">Our services</a></li>
					<li><a href="About.php">About</a></li>
					<li><a href="Contacts.php">Contacts</a></li>
					<li><a href="Reviews.php">Reviews</a></li>
					<li><a href="Market.php">Market</a></li>
					
				</ul>
			</nav>
			<hr>
			<div class="menu-options">
				<ul>
					<li><a href="#">Catalog</a></li>
					<li><a href="#">Help Center</a></li>
					<li><a href="#">Chat</a></li>
					<li><a href="#">Category</a></li>
				   
				</ul>
			</div>
			<hr>
			<div class="user-actions">
				<ul>
					<li><a href="#">My Orders</a></li>
					<li><a href="cart.php">Cart</a></li>
					<li><a href="#">Personalized Offers</a></li>
					<li><a href="#">Wishlists</a></li>
				  
				</ul>
			</div>
		</div>

		<main>
        <section class="reviews">
            <h1>Відгуки користувачів</h1>
            <?php foreach ($reviews as $review): ?>
                <div class="review">
                    <h2><?php echo $review['first_name'] . ' ' . $review['last_name']; ?></h2>
                    <p>Користувач: <?php echo $review['username']; ?></p>
                    <p>Email: <?php echo $review['email']; ?></p>
                    <p>Phone: <?php echo $review['phone']; ?></p>
                    <p><?php echo $review['message']; ?></p>
                    <small><?php echo $review['created_at']; ?></small>
                </div>
            <?php endforeach; ?>
        </section>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="section_feedback">
                <div class="wrapper">
                    <form action="Reviews.php" method="POST">
                        <h1>Feedback</h1>
                        <div class="input-box">
                            <input type="text" name="LastName" placeholder="Last name" required>
                            <input type="text" name="FirstName" placeholder="First name" required>
                            <input type="email" name="Email" placeholder="Email" required>
                            <input type="phone" name="Phone" placeholder="Phone" required>
                        </div>
                        <div class="input-box">
                            <textarea name="Message" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn">Send</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p>Будь ласка, <a href="login.php">увійдіть</a>, щоб залишити відгук.</p>
        <?php endif; ?>
    </main>


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

<script src="burger.js" defer></script>

<script>
const myBtnSmooth = document.getElementById('my-btn-smooth');

myBtnSmooth.addEventListener('click', function () {
	document.getElementById('my-target-smooth').scrollIntoView(
		{ behavior: "smooth", block: "start" }
	);
});
</script>





</body>

</html>
