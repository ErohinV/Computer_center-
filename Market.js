document.addEventListener('DOMContentLoaded', function () {
    const addProductForm = document.getElementById('addProductForm');
    const productList = document.querySelector('.product-list');

    addProductForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const productName = addProductForm.querySelector('#productName').value;
        const productDescription = addProductForm.querySelector('#productDescription').value;
        const productPrice = addProductForm.querySelector('#productPrice').value;
        const productImage = addProductForm.querySelector('#productImage').files[0];

        // Додайте код для створення HTML-структури для нового продукту
        const productElement = document.createElement('div');
        productElement.classList.add('product');

        // Додайте зображення продукту
        const imageElement = document.createElement('img');
        imageElement.src = URL.createObjectURL(productImage);
        imageElement.alt = productName;
        productElement.appendChild(imageElement);

        // Додайте назву продукту
        const nameElement = document.createElement('h2');
        nameElement.textContent = productName;
        productElement.appendChild(nameElement);

        // Додайте опис продукту
        const descriptionElement = document.createElement('p');
        descriptionElement.textContent = productDescription;
        productElement.appendChild(descriptionElement);

        // Додайте ціну продукту
        const priceElement = document.createElement('p');
        priceElement.textContent = `Price: ${productPrice}₴`;
        productElement.appendChild(priceElement);

        // Додайте продукт до списку
        productList.appendChild(productElement);

        // Очистіть форму
        addProductForm.reset();
    });
});
