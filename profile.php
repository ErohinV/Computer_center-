<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
    <link rel="stylesheet" href="profil.css">
	<script src="login-regista.js"> </script>
	<script src="login.js" defer></script>
	<title>Computer Repair</title>
	
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
					<li><a href="Market.php">Catalog</a></li>
					
				</ul>
			</nav>
			<hr>
			<div class="menu-options">
				<ul>
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
	</header>
	<main>
        <?php if (isset($_SESSION['username'])): ?>
            
            <!-- Інший контент сторінки профілю -->
        <?php else: ?>
            <h1>Ви не авторизовані. Будь ласка, увійдіть в систему.</h1>
        <?php endif; ?>
    </main>
	<main class="profile">
		<section id="services" class="profile-section">
			<h2 class="section-title"></h2>	
			<div class="services-list">
				<a href="repairs.php">
				<div class="service">
					<div class="service-icon">
						<img src="img/hardware-chip-outline.svg" alt="" class="icon">
					</div>
					<div class="service-content">
						<h3 class="service-title">Readiness of your repair</h3>
						<p class="service-description">Track the repair of your equipment online.</p>
					</div>
				</div>
		</a>

		
				<a href="cart.php">
    <div class="service">
        <div class="service-icon">
            <img src="img/repeat-outline.svg" alt="Readiness of Repair Icon" class="icon">
           
        </div>
        <div class="service-content">
            <h3 class="service-title">Cart</h3>
            <p class="service-description">Your shopping cart for online orders</p>
        </div>
    </div>
</a>



				
				<a href="">
				<div class="service">
					<div class="service-icon">
						<img src="img/bag-handle-outline.svg" alt="Order Tracking Icon" class="icon">
					</div>
					<div class="service-content">
						<h3 class="service-title">Tracking Your Orders</h3>
						<p class="service-description">Track Your Order During Delivery.</p>
					</div>
				</div>
		</a>
					
			</div>
		</section>
		<!-- Інші розділи сторінки профілю -->
	</main>
	<script>
		document.addEventListener('DOMContentLoaded', () => {
    // Завантажуємо кількість товарів у кошику з сервера
    updateCartCount();
});

function updateCartCount() {
    fetch('get_cart_count.php')
        .then(response => response.json())
        .then(data => {
            const cartCountElement = document.querySelector('.cart-count');
            cartCountElement.textContent = data.count;
            cartCountElement.style.display = data.count > 0 ? 'block' : 'none';
        })
        .catch(error => console.error('Error:', error));
}

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
            updateCartCount();
            alert('Product added to cart!');
        } else {
            alert('Failed to add product to cart.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


		</script>
	
	
<hr>
	<footer class="footer">
		<div class="footer_box">
			<div class="footer_groups">
				<div class="footer_title">© 2024 All rights reserved 
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

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>