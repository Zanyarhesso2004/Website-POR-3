    <?php

    // Auteur: Zanyar
    // Function: edit car

    // Inclusief de databaseverbinding
    include_once "pdo_connection.php";

    // Initialiseren van variabelen om waarschuwingen te voorkomen
    $naam = "";
    $merk = "";
    $prijs = "";
    $afbeelding = "";

    // Controleer of de productcode is ingesteld en haal deze op uit de URL
    if(isset($_GET['id'])) {
        $productcode = $_GET['id'];

        // Haal de gegevens van het product op uit de database
        $sql = "SELECT * FROM product WHERE productcode = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$productcode]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $naam = $row['naam'];
            $merk = $row['merk'];
            $prijs = $row['prijs'];
            $afbeelding = $row['afbeelding'];
        } 
    } else {
        // Geen productcode opgegeven in de URL
        echo "Productcode niet opgegeven.";
        exit();
    }

    // Controleer of het formulier is verzonden
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Haal de ingevulde gegevens uit het formulier
        $naam = $_POST['naam'];
        $merk = $_POST['merk'];
        $prijs = $_POST['prijs'];
        $afbeelding = $_POST['afbeelding'];

        // Update de gegevens van het product in de database
        $sql = "UPDATE product SET naam=?, merk=?, prijs=?, afbeelding=? WHERE productcode=?";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute([$naam, $merk, $prijs, $afbeelding, $productcode])) {
            $message = "Product succesvol bijgewerkt."; // Stel het bericht in
        } else {
            echo "Fout bij het bijwerken van het product.";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product bewerken - Autokopen.nl</title>
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
                </div>
            </div>
            <a href="#">Over ons</a>
        </div>

        <div class="content">
            <h2>Product bewerken</h2>

            <!-- Melding weergeven -->
            <?php if(!empty($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>

            <!-- Formulier om productgegevens te bewerken -->
            <form action="" method="post">
                <input type="text" name="naam" placeholder="Naam" value="<?php echo htmlspecialchars($naam); ?>"><br>
                <input type="text" name="merk" placeholder="Merk" value="<?php echo htmlspecialchars($merk); ?>"><br>
                <input type="number" name="prijs" placeholder="Prijs" step="any" value="<?php echo htmlspecialchars($prijs); ?>"><br>
                <input type="text" name="afbeelding" placeholder="Afbeelding URL" value="<?php echo htmlspecialchars($afbeelding); ?>"><br>
                <button type="submit">Bijwerken</button>
            </form>

            <!-- Link om terug te gaan naar producten.php -->
            <a href="producten.php">Terug naar Producten</a>
        </div>

        <footer>
            <p>@ 2024 Autokopen.nl</p>
        </footer>

    </body>
    </html>
