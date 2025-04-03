<?php include 'shirt.html'; ?>
<?php

// Получить данные формы
$product_id = $_POST['product_id'];
$quantity = 1; // По умолчанию количество равно 1

// Подключиться к базе данных
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "одежда";

// Создать соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверить, существует ли товар в корзине
$sql = "SELECT * FROM cart WHERE product_id = $product_id  AND user_id =1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Если товар уже существует в корзине, обновить количество
  $row = $result->fetch_assoc();
  $quantity += $row['quantity'];

  $sql = "UPDATE cart SET quantity = $quantity WHERE id = " . $row['id'];
  $conn->query($sql);
} else {
  // Если товара нет в корзине, добавить его
  $sql = "INSERT INTO cart (product_id, quantity, user_id) VALUES ($product_id, $quantity,1)";
  $conn->query($sql);
}

// Закрыть соединение с базой данных
$conn->close();

?>