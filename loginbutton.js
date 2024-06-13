const loginButton = document.getElementById("login-button");
const modalContainer = document.getElementById("login-modal");
const closeModalBtn = document.querySelector(".close-modal");

// Показувати модальний контейнер при натисканні на кнопку
loginButton.addEventListener("click", () => {
  modalContainer.style.display = "block";
});

// Закривати модальний контейнер
closeModalBtn.addEventListener("click", () => {
  modalContainer.style.display = "none";
});

