<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "shopcenter";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("<h2>Connection failed:</h2> " . $conn->connect_error);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = "SELECT password FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        echo "<h1>Login Successful</h1>";
        echo "<p>Welcome, $email!</p>";
        echo "<a href='shop.html'>→ Go to Shop</a>";
    } else {
        echo "<h1>Login Failed</h1>";
        echo "<p>Incorrect password.</p>";
        echo "<a href='login.html'>← Try Again</a>";
    }
} else {
    echo "<h1>Login Failed</h1>";
    echo "<p>Email not registered.</p>";
    echo "<a href='newaccount.html'>← Create Account</a>";
}

$stmt->close();
$conn->close();
?>
