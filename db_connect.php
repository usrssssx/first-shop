
<?php

// Подключиться к базе данных
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "одежда";

// Создать соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Получить товары из корзины
$sql = "SELECT * FROM cart WHERE user_id = 1"; // Предполагается, что user_id равен 1
$result = $conn->query($sql);

// Обработать результаты
$cart_items = [];
$total_price = 0;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    // Получить данные о товаре
    $product_id = $row['product_id'];
    $sql = "SELECT * FROM одежда WHERE product_id = $product_id";
    $product_result = $conn->query($sql);
    $product = $product_result->fetch_assoc();

    // Добавить товар в корзину
    $cart_items[] = [
      'name' => $product['Модель'],
      'quantity' => $row['quantity'],
      'price' => $product['Цена'],
    ];

    // Рассчитать общую цену
    $total_price += $row['quantity'] * $product['Цена'];
  }
}

// Закрыть соединение с базой данных
$conn->close();
?>