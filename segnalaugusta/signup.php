<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - SegnalAugusta</title>
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
        <h2>Registrazione</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Registrati</button>
        </form>
    </main>
</body>
</html>
