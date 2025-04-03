<?php include 'shirt.html'; ?>

<?php

// Получить идентификатор товара
$product_id = $_GET['product_id'];


// Подключиться к базе данных
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "одежда";

// Создать соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Удалить товар из корзины
$sql = "DELETE FROM cart WHERE product_id = $product_id AND user_id = 1"; // Предполагается, что user_id равен 1
$conn->query($sql);

// Закрыть соединение с базой данных
$conn->close();

?>