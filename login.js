// Отримання посилань на кнопку "Логін" і діалогове вікно реєстрації
var loginButton = document.getElementById('login-button');
var registrationDialog = document.getElementById('registration-dialog');
var closeButton = document.getElementById('close-button');
var page = document.querySelector('.page'); // Посилання на головну сторінку

// Додавання події кліку на кнопку "Логін"
loginButton.addEventListener('click', function() {
    // Показ діалогового вікна реєстрації
    registrationDialog.style.display = 'block';
    // Додавання класу блюра головної сторінки
    page.classList.add('blur-background');
});

// Додавання події кліку на кнопку закриття
closeButton.addEventListener('click', function() {
    // Закриття діалогового вікна реєстрації
    registrationDialog.style.display = 'none';
    // Видалення класу блюра головної сторінки
    page.classList.remove('blur-background');
});

