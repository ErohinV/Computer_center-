document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.nav_en').addEventListener('click', function (event) {
        event.preventDefault();
        fetchTranslation('en');
    });

    document.querySelector('.nav_ua').addEventListener('click', function (event) {
        event.preventDefault();
        fetchTranslation('ua');
    });

    // Опис функції для виклику перекладу
    function fetchTranslation(language) {
        fetch('translations.json')
            .then(response => response.json())
            .then(data => {
                // Отримуємо всі елементи, які мають ключ для перекладу
                const elements = document.querySelectorAll('[key="translator"]');
                elements.forEach(element => {
                    // Отримуємо ключ для перекладу з атрибута "key"
                    const translationKey = element.getAttribute('key');
                    // Перевіряємо, чи є переклад для даного ключа в обраній мові
                    if (data[language][translationKey]) {
                        // Задаємо текст знайденого перекладу
                        element.textContent = data[language][translationKey];
                    }
                });
            });
    }
});
