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

    // Affichage pour le débogage
    echo "Form data received: Name - $name, Email - $email, Password - $password<br>";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Affichage pour le débogage
        echo "Insertion réussie<br>";
        // Supprimer l'instruction echo et réactiver la redirection une fois que tout fonctionne correctement
        header("Location: /public/Connexion/verif.html");
        exit();
    } else {
        echo "Erreur lors de l'inscription: " . htmlspecialchars($stmt->error) . "<br>";
        header("Location: /public/Connexion/verif.html");
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No POST data received.<br>";
}
?>
