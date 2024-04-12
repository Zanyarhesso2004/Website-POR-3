<?php
$hostname = "localhost";
$username = "root"; 
$password = ""; 
$database = "webshop123";

try {
    // PDO-verbinding
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    
    // Zet de PDO-error mode op exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Als er een fout optreedt, toon dan een foutmelding en stop de scriptuitvoering
    die("Verbindingsfout: " . $e->getMessage());
}
?>
