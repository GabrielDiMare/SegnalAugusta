<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = 'Aperto'; // Status predefinito

    $sql = "INSERT INTO reports (user_id, username, type, description, priority, status, latitude, longitude) 
            VALUES ('$user_id', '$username', '$type', '$description', '$priority', '$status', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuova segnalazione creata con successo";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>SegnalAugusta - Nuova Segnalazione</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="js/script.js" defer></script>
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
        <div id="map"></div>
        <form id="reportForm" method="POST">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <label for="type">Tipo di segnalazione:</label>
            <select name="type" id="type" required>
                <option value="Rifiuti">Rifiuti</option>
                <option value="Illuminazione">Illuminazione</option>
                <option value="Strada">Strada</option>
                <option value="Altro">Altro</option>
            </select>
            <label for="description">Descrizione:</label>
            <textarea name="description" id="description" required></textarea>
            <label for="priority">Priorità:</label>
            <select name="priority" id="priority" required>
                <option value="Bassa">Bassa</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>
            <button type="submit">Invia Segnalazione</button>
        </form>
    </main>
</body>
</html>
