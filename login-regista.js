// Отримати посилання на кнопку "Login"
var loginButton = document.getElementById('login-button');

// Отримати посилання на кнопку переключення на реєстрацію
var toggleRegistrationButton = document.getElementById('toggle-registration-button');

// Додати подію кліку на кнопку "Login"
loginButton.addEventListener('click', function() {
    // Ваша логіка для кнопки "Login" тут
});

// Додати подію кліку на кнопку переключення на реєстрацію
const registrationButton = document.getElementById('registration-button');

    // Додаємо обробник події для клікання на кнопку "Register"
    registrationButton.addEventListener('click', function() {
        // Переадресовуємо користувача на профільну сторінку після успішної реєстрації
        window.location.href = 'profile.php';
    });