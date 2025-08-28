<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "shopcenter";


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("<h2>Connection failed:</h2> " . $conn->connect_error);
}

/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'] ?? 'Unknown';

    
    $stmt = $conn->prepare("INSERT INTO orders (product_name) VALUES (?)");
    $stmt->bind_param("s", $product);

    if ($stmt->execute()) {
        echo "<h1>✅ Order Placed Successfully!</h1>";
        echo "<p>Product: <strong>$product</strong></p>";
        echo "<p>Thank you for your purchase.</p>";
        echo "<a href='shop.html'>← Back to Shop</a>";
    } else {
        echo "<h2>❌ Failed to place order:</h2> " . $conn->error;
    }

    $stmt->close();
} else {
    echo "<h2>Invalid request method.</h2>";
}

$conn->close();
?>
