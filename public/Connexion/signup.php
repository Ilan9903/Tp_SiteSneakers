<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mon_site";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérification de la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $address = $_POST['adresse'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    // Hacher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL
    $stmt = $conn->prepare("INSERT INTO user (email, adresse, password, phone_number, zip, city, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $email, $adresse, $hashed_password, $phone_number, $zip, $city, $country);

    if ($stmt->execute()) {
        echo "Inscription réussie.";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
}
?>
