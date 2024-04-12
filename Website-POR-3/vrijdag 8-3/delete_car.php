<?php
// Auteur: Zanyar
// Function: delete car

// Inclusief de databaseverbinding
include_once "pdo_connection.php";

// Functie om een auto te verwijderen
function deleteCar($pdo, $productcode) {
    try {
        // SQL-query om een auto te verwijderen
        $sql = "DELETE FROM product WHERE productcode = ?";
        
        // Bereid de SQL-query voor
        $stmt = $pdo->prepare($sql);
        
        // Voer de query uit
        $stmt->execute([$productcode]);
        
        // Als de auto succesvol is verwijderd, toon een pop-upbericht
        echo "<script>alert('Auto succesvol verwijderd.'); window.location.href = 'Producten.php';</script>";
        exit(); 
    } catch (PDOException $e) {
        // Als er een fout optreedt bij het verwijderen van de auto, toon dan een foutmelding
        echo "Er is een fout opgetreden bij het verwijderen van de auto: " . $e->getMessage();
    }
}

// Controleer of er een productcode is meegegeven via GET
if(isset($_GET['id'])) {
    // Ontvang de productcode van de URL
    $productcode = $_GET['id'];
    
    // Roep de functie deleteCar aan om de auto te verwijderen
    deleteCar($pdo, $productcode);
} else {
    // Als er geen productcode is meegegeven, toon dan een foutmelding
    echo "Geen productcode opgegeven voor verwijdering.";
}
?>
