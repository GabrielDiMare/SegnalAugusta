<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM reports WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account - SegnalAugusta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>SegnalAugusta</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="account.php">Account</a>
            <a href="info.php">Info</a>
        </nav>
    </header>
    <main>
        <h2>Benvenuto, <?php echo $username; ?></h2>
        <h3>Le tue segnalazioni</h3>
        <div class="table-container">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descrizione</th>
                        <th>Priorità</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['priority']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <a href="logout.php" class="button">Logout</a>
    </main>
</body>
</html>