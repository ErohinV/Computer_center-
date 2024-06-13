function updateProfileImage(event) {
    // Отримуємо посилання на зображення
    var image = document.getElementById('profile-image');
    
    // Перевіряємо, чи вибране файлове зображення
    if (event.target.files && event.target.files[0]) {
        // Отримуємо обране зображення
        var selectedImage = event.target.files[0];
        
        // Створюємо об'єкт URL для зображення
        var imageURL = URL.createObjectURL(selectedImage);
        
        // Змінюємо посилання на зображення для відображення нового зображення
        image.src = imageURL;
    }
}