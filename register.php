<?php
// Database config
$host = "localhost";
$user = "root";
$pass = "1234";
$db = "shopcenter";

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("<h2>Connection failed:</h2> " . $conn->connect_error);
}


$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');


if (empty($email) || empty($password)) {
    echo "<h2>Please fill in all fields.</h2>";
    exit;
}


$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo "<h2>Email is already registered.</h2>";
    echo "<a href='newaccount.html'>← Try with a different email</a>";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
$insert->bind_param("ss", $email, $hashed_password);

if ($insert->execute()) {
    echo "<h2>✅ Account created successfully!</h2>";
    echo "<a href='login.html'>→ Go to Login</a>";
} else {
    echo "<h2>Error:</h2> " . $conn->error;
}

$insert->close();
$conn->close();
?>
