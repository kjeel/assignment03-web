<?php
$mysqli = new mysqli("db", "root", "example", "lv_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $stmt = $mysqli->prepare("INSERT INTO anmeldungen (vorname, nachname) VALUES (?, ?)");
    $stmt->bind_param("ss", $vorname, $nachname);
    $stmt->execute();
}

$result = $mysqli->query("SELECT vorname, nachname FROM anmeldungen");
?>

<!DOCTYPE html>
<html>
<head><title>LV-Anmeldung</title></head>
<body>
    <form method="post">
        Vorname: <input name="vorname" required><br>
        Nachname: <input name="nachname" required><br>
        <button type="submit">Anmelden</button>
    </form>
    <h2>Angemeldete Studierende</h2>
    <ul>
    <?php while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["vorname"]) . " " . htmlspecialchars($row["nachname"]) . "</li>";
    } ?>
    </ul>
</body>
</html>
