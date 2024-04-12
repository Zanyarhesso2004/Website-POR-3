<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten - Autokopen.nl</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <a href="Home.html">Home</a> 
    <div class="dropdown">
        <button class="dropbtn">Auto's</button>
        <div class="dropdown-content">
            <a href="Producten.php">Producten</a>
            <a href="Bestelling.html">Bestelling</a>
            <a href="Klanten.html">Klanten</a>
            <a href="Leveranciers.html">Leveranciers</a>
            <!-- Voeg hier eventueel andere automerken toe -->
        </div>
    </div>
    <a href="contact form/index.html" target="_blank">Over ons</a>
    <!-- Voeg hier eventueel andere navigatielinks toe -->
</div>

<div class="content">
    <h2>Producten</h2>

    <form action="add_car.php" method="POST"> <!-- Toegevoegd action-attribuut en method-attribuut -->
        <div class="input-container">
            <input type="text" name="naam" placeholder="Naam" required>
            <input type="text" name="merk" placeholder="Merk" required>
            <input type="text" name="prijs" placeholder="Prijs" pattern="\d+(\.\d{1,2})?" title="Voer een geldig getal in (bijv. 10.99)" min="0" step="0.01" required> 
            <input type="text" name="afbeelding" placeholder="Afbeelding URL" required>
        </div>
        <button class="input-button" type="submit">Toevoegen</button> <!-- Submit-knop toegevoegd -->
    </form>
    

    <!-- Tabel met bestaande auto's -->
    <table>
        <thead>
            <tr>
                <th>Productcode</th>
                <th>Naam</th>
                <th>Merk</th>
                <th>Prijs</th>
                <th>Afbeelding</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Inclusief de databaseverbinding
            include_once "pdo_connection.php";

             // SQL-query om alle gegevens op te halen uit de tabel "product"
            $sql = "SELECT * FROM product";

             // Voer de SQL-query uit en sla het resultaat op in $stmt
            $stmt = $pdo->query($sql);

            // Controleren of er resultaten zijn
            if ($stmt->rowCount() > 0) {
                // Output gegevens van elke rij
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['productcode']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['naam']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['merk']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prijs']) . "</td>";
                    echo "<td><img src='img/" . htmlspecialchars($row['afbeelding']) . "' alt='Productafbeelding'></td>";
                    echo "<td>";
                    echo "<a class='edit-button' href='edit_car.php?id=" . htmlspecialchars($row['productcode']) . "'>Bewerken</a>";
                    echo "<a class='delete-button' href='delete_car.php?id=" . htmlspecialchars($row['productcode']) . "'>Verwijderen</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Geen auto's gevonden</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<footer>
    <p>@ 2024 Autokopen.nl</p>
</footer>
</body>
</html>
