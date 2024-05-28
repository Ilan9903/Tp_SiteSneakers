<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL
    $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Rediriger vers la page de confirmation
        header("Location: confirmation.html");
    } else {
        $message = "Erreur lors de l'inscription: " . htmlspecialchars($stmt->error);
        // Rediriger vers la page d'inscription avec un message d'erreur
        header("Location: signin.html?message=" . urlencode($message));
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
    exit();
} else {
    echo "No POST data received.<br>";
}
?>


