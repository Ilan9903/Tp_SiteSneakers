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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Redirection après l'insertion réussie
        echo "Redirection réussie après l'insertion.";
        header("Location: /public/Connexion/verif.html");
        exit();
    } else {
        // En cas d'erreur lors de l'insertion, rediriger également vers la page de vérification
        echo "Erreur lors de l'insertion.";
        header("Location: /public/Connexion/verif.html");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Si aucune donnée POST n'est reçue, rediriger également vers la page de vérification
    echo "Aucune donnée POST reçue.";
    header("Location: /public/Connexion/verif.html");
    exit();
}
?>
