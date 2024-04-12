<?php

// Auteur: Zanyar
// Function: add car

// Inclusief de databaseverbinding
include_once "pdo_connection.php"; 

// Controleren of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de gegevens van het formulier
    $naam = $_POST['naam'];
    $merk = $_POST['merk'];
    $prijs = $_POST['prijs'];
    $afbeelding = $_POST['afbeelding'];

    try {
        // een nieuwe auto toe te voegen
        $sql = "INSERT INTO product (naam, merk, prijs, afbeelding) VALUES (:naam, :merk, :prijs, :afbeelding)";
        $stmt = $pdo->prepare($sql);

        // Binding van parameters om SQL Injection te voorkomen
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':merk', $merk);
        $stmt->bindParam(':prijs', $prijs);
        $stmt->bindParam(':afbeelding', $afbeelding);

        // Uitvoeren van de query
        $stmt->execute();

        // succesbericht
        echo "<script>alert('Auto succesvol toegevoegd.'); window.location.href = 'Producten.php';</script>";
        exit(); // Zorg ervoor dat het script hier stopt
    } catch (PDOException $e) {
        // Vang de fout op en geef deze weer
        echo "Error: " . $e->getMessage();
    }
}
?>
