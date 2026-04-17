<?php
include 'connect.php';

// Insert customers
$conn->query("INSERT INTO customers (name, email) VALUES ('Teja', 'teja@gmail.com')");

// Insert products
$conn->query("INSERT INTO products (product_name, price) VALUES ('Laptop', 50000)");

// Insert orders
$conn->query("INSERT INTO orders (customer_id, product_id, quantity, order_date)
VALUES (1, 1, 2, '2025-01-01')");

echo "Data inserted successfully!";
?>
