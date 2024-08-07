<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $status = 'Aperto'; // Status predefinito

    $sql = "INSERT INTO reports (user_id, username, type, description, priority, status, latitude, longitude) VALUES ('$user_id', '$username', '$type', '$description', '$priority', '$status', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {
        $message = "Segnalazione creata con successo.";
    } else {
        $message = "Errore: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SegnalAugusta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <?php if ($message): ?>
            <script>
                alert("<?php echo $message; ?>");
            </script>
        <?php endif; ?>
        <div id="map"></div>
        <form id="reportForm" method="POST">
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <label for="type">Tipo di segnalazione:</label>
            <select name="type" id="type" required>
                <option value="Rifiuti">Rifiuti</option>
                <option value="Illuminazione">Illuminazione</option>
                <option value="Strada">Strada</option>
				<option value="Fognature">Fognature</option>
				<option value="Acqua potabile">Acqua potabile</option>
				<option value="Verde pubblico">Verde pubblico</option>
				<option value="Rumore">Rumore</option>
				<option value="Animali randagi">Animali randagi</option>
				<option value="Edilizia abusiva">Edilizia abusiva</option>
				<option value="Segnaletica">Segnaletica</option>
				<option value="Parcheggi">Parcheggi</option>
				<option value="Servizi pubblici">Servizi pubblici</option>
				<option value="Sicurezza">Sicurezza</option>
				<option value="Igiene urbana">Igiene urbana</option>
				<option value="Barriere architettoniche">Barriere architettoniche</option>
				<option value="Trasporti pubblici">Trasporti pubblici</option>
				<option value="Edifici pubblici">Edifici pubblici</option>
				<option value="Aree gioco per bambini">Aree gioco per bambini</option>
				<option value="Illuminazione natalizia">Illuminazione natalizia</option>
				<option value="Eventi culturali">Eventi culturali</option>
				<option value="Manutenzione cimitero">Manutenzione cimitero</option>
				<option value="Lavori in corso">Lavori in corso</option>
				<option value="Tombini intasati">Tombini intasati</option>
				<option value="Abbandono di rifiuti ingombranti">Abbandono di rifiuti ingombranti</option>
				<option value="Infestazioni">Infestazioni</option>
				<option value="Vandalismo">Vandalismo</option>
				<option value="Inquinamento">Inquinamento</option>
				<option value="Abbandono di veicoli">Abbandono di veicoli</option>
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
