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
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        

        .number2 {
            margin: 50px auto; /* Задає зовнішній відступ від краю сторінки та автоматично вирівнює блок по центру */
            max-width: 800px; /* Задає максимальну ширину блоку */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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




		<div class="header_box ">
            <div class="header_margin">
                <div class="header_title" data-key="title">
                    
                </div>
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
		
		<section class="offer">
			<div class="filter">
				<label for="serviceFilter">Filter by Category:</label>
				<select id="serviceFilter">
					<option value="all">All</option>
					<option value="Basic">Basic</option>
					<option value="Additional">Additional</option>
					<option value="Call">Call</option>
				</select>
			</div>
			<div class="offer_box">
				<div class="offer_imgs">
					<div class="offer_img" data-service="Diagnostic" data-category="Basic">
						<img src="img/group1.jpg" alt="1">
						<p>DIAGNOSTIC</p>
					</div>
					<div class="offer_img" data-service="Cleaning" data-category="Basic">
						<img src="img/computer_maintenance.jpg" alt="2">
						<p>CLEANING</p>
					</div>
					<div class="offer_img" data-service="Replacement" data-category="Basic">
						<img src="img/group3.jpg" alt="3">
						<p>REPLACEMENT</p>
					</div>
					<div class="offer_img" data-service="Upgrade" data-category="Basic">
						<img src="img/group4.jpg" alt="4">
						<p>UPGRADE</p>
					</div>
				</div>
				<div>
					
				</div>
				<div class="offer_imgs">
					<div class="offer_img" data-service="Virus Removal" data-category="Additional">
						<img src="img/group5.jpg" alt="5">
						<p>VIRUS REMOVAL</p>
					</div>
					<div class="offer_img" data-service="Data Recovery" data-category="Additional">
						<img src="img/group6.jpg" alt="6">
						<p>DATA RECOVERY</p>
					</div>
					<div class="offer_img" data-service="Network Setup" data-category="Additional">
						<img src="img/group7.jpg" alt="7">
						<p>NETWORK SETUP</p>
					</div>
					<div class="offer_img" data-service="Software" data-category="Additional">
						<img src="img/group8.jpg" alt="8">
						<p>SOFTWARE</p>
					</div>
				</div>
				<div class="offer_imgs">
					<div class="offer_img" data-service="Server Maintenance" data-category="Call">
						<img src="img/group9.jpg" alt="5">
						<p>SERVER MAINTENANCE</p>
					</div>
					<div class="offer_img" data-service="Repair of Monitors" data-category="Additional">
						<img src="img/group10.jpg" alt="6">
						<p>REPAIR OF MONITORS</p>
					</div>
					<div class="offer_img" data-service="Courier" data-category="Call">
						<img src="img/group11.jpg" alt="7">
						<p>COURIER</p>
					</div>
					<div class="offer_img" data-service="Repair & Firmware" data-category="Additional">
						<img src="img/group12.jpg" alt="8">
						<p>REPAIR & FIRMWARE</p>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Модальне вікно з єдиною формою -->
		<div id="serviceModal" class="modal">
			<div class="modal-content">
				<span class="close">&times;</span>
				<h2 id="serviceTitle"></h2>
				<form id="serviceForm">
					<label for="name">Ім'я</label>
					<input type="text" id="name" name="name" required>
					<label for="email">Email</label>
					<input type="email" id="email" name="email" required>
					<label for="details">Деталі</label>
					<textarea id="details" name="details" required></textarea>
					<label for="phone">Телефон (необов'язково)</label>
					<input type="text" id="phone" name="phone" value="+380">
					<label for="address">Адреса (необов'язково)</label>
					<input type="text" id="address" name="address">
					<input type="submit" value="Відправити">
				</form>
			</div>
		</div>
		
		<div id="myModal" class="modal">
			<div class="modal-content">
				<span class="close" onclick="closeModal()">&times;</span>
				<p id="modalContent"></p>
			</div>
		</div>
		
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				var serviceModal = document.getElementById("serviceModal");
				var closeModal = document.getElementsByClassName("close")[0];
				var serviceTitle = document.getElementById("serviceTitle");
				var serviceFilter = document.getElementById("serviceFilter");
				var serviceForm = document.getElementById("serviceForm");
		
				document.querySelectorAll(".offer_img").forEach(function(element) {
					element.addEventListener("click", function() {
						var service = element.getAttribute("data-service");
						serviceTitle.textContent = service;
						serviceModal.style.display = "block";
					});
				});
		
				closeModal.addEventListener("click", function() {
					serviceModal.style.display = "none";
				});
		
				window.addEventListener("click", function(event) {
					if (event.target == serviceModal) {
						serviceModal.style.display = "none";
					}
				});
		
				serviceFilter.addEventListener("change", function() {
					var selectedCategory = serviceFilter.value;
					document.querySelectorAll(".offer_img").forEach(function(element) {
						if (selectedCategory === "all" || element.getAttribute("data-category") === selectedCategory) {
							element.style.display = "block";
						} else {
							element.style.display = "none";
						}
					});
				});
		
				serviceForm.addEventListener("submit", function(event) {
					event.preventDefault();
		
					var formData = {
						service: serviceTitle.textContent,
						name: document.getElementById("name").value,
						email: document.getElementById("email").value,
						details: document.getElementById("details").value,
						phone: document.getElementById("phone").value,
						address: document.getElementById("address").value
					};
		
					if (!formData.name || !formData.email || !formData.details) {
						alert("Будь ласка, заповніть усі обов'язкові поля.");
						return;
					}
		
					var storedData = JSON.parse(localStorage.getItem('formData')) || [];
					storedData.push(formData);
					localStorage.setItem('formData', JSON.stringify(storedData));
		
					alert("Форма відправлена для послуги: " + serviceTitle.textContent);
					serviceModal.style.display = "none";
					serviceForm.reset();
				});
			});
		
			function showInfo(info) {
				var modal = document.getElementById('myModal');
				var modalContent = document.getElementById('modalContent');
				modalContent.innerHTML = info;
				modal.style.display = 'flex';
			}
		
			function closeModal() {
				var modal = document.getElementById('myModal');
				modal.style.display = 'none';
			}
		</script>
		
		
        
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <p id="modalContent"></p>
            </div>
        </div>
        
        <script>
            function showInfo(info) {
                // Отримати елемент модального вікна та його вміст
                var modal = document.getElementById('myModal');
                var modalContent = document.getElementById('modalContent');
        
                // Задати вміст модального вікна
                modalContent.innerHTML = info;
        
                // Показати модальне вікно
                modal.style.display = 'flex';
            }
        
            function closeModal() {
                // Закрити модальне вікно
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            }
        </script>

		<section class="number">
			<h2 class="number_title">FAST & EASY
			</h2>
			<p class="number_subtitle">our work process</p>
			<number class="number_groups">
				<div class="number_group">
					<div>01. REQUEST YOUR QUOTE</div>
					<p>We will be there when you most need us
					</p>
				</div>
				<div class="number_group">
					<div>02. BRING YOUR LAPTOP
					</div>
					<p>At heart, we're guys with laptops
					</p>
				</div>
				<div class="number_group">
					<div>03. GET IT REPAIRED</div>
					<p>High-quality and inexpensive repair of laptops
					</p>
				</div>
			</number>
		</section>

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
