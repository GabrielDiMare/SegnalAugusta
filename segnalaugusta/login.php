<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SegnalAugusta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>SegnalAugusta</h1>
        <nav>
            <a href="login.php">Login</a>
            <a href="signup.php">Registrazione</a>
        </nav>
    </header>
    <main>
        <h2>Login</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>
