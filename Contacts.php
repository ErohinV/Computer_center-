<?php
session_start();
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
	<title>Computer Repair</title>
	<style>
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
					<li><a href="Our services.html">Our services</a></li>
					<li><a href="About.html">About</a></li>
					<li><a href="Contacts.html">Contacts</a></li>
					<li><a href="Reviews.html">Reviews</a></li>
					<li><a href="Market.html">Market</a></li>
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
					<li><a href="#">Cart</a></li>
					<li><a href="#">Personalized Offers</a></li>
					<li><a href="#">Wishlists</a></li>
				</ul>
			</div>
		</div>

		<div class="header_box">
            <div class="header_margin">
                <div class="header_title" data-key="title"></div>
                <button id="my-btn-smooth" class="animated-button1 uk-button uk-button-primary" data-key="button">
                    WRITE TO US
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
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
		<div class="main_groups">
			<div class="main_call main_group">
				<img src="img/call.svg" alt="call">
				<h3>CALL US NOW FOR THE PHONE: +380636745386 </h3>
				<p>Feel free to call us</p>
			</div>

			<div class="main_calendar main_group">
				<img src="img/calendar 2.svg" alt="call">
				<h3>ONLINE CALENDAR</h3>
				<a href="Календар.html"><p> Our Working Days</p> </a>
			</div>

			<div class="main_geo main_group">
				<img src="img/maps-and-flags 1.svg" alt="call">
				<h3>OUR SERVICE CENTER</h3>
				<p>Kolomyia st. I. Mazepa 258-A</p>
			</div>
		</div>

		<div class="section_feedback uk-tile" id="my-target-smooth">
			<div class="wrapper">
				<form action="https://formspree.io/f/mrgwnnrr" method="POST">
					<h1>Feedback</h1>
					<div class="input-box">
						<input type="text" name="Last name" id="Last name" placeholder="Last name" required>
						<input type="text" name="First name" id="First name" placeholder="First name" required>
						<input type="email" id="Email" type="email" placeholder="Email" required>
						<input type="phone" name="Phone" id="Phone" placeholder="Phone" required>
					</div>
					<div class="input-box">
						<textarea class="wrapper-feedback" name="Message" id="Message" placeholder="Message"></textarea>
					</div>
					<button type="submit" class="btn">Send</button>
				</form>
			</div>
		</div>
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
