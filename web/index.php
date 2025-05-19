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
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>LV-Anmeldung</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            font-size: 1em;
            background: #0069d9;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #0053b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
        }

        li {
            background: #f0f2f5;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lehrveranstaltung Anmeldung</h1>
        <form method="post">
            <input type="text" name="vorname" placeholder="Vorname" required>
            <input type="text" name="nachname" placeholder="Nachname" required>
            <button type="submit">Anmelden</button>
        </form>

        <h2>Angemeldete Studierende</h2>
        <ul>
        <?php while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row["vorname"]) . " " . htmlspecialchars($row["nachname"]) . "</li>";
        } ?>
        </ul>
    </div>
</body>
</html>
