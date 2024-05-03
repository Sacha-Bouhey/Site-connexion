<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
    <link rel="stylesheet" href="Library/stylesheet.css">
</head>
<body>
    <div class="bandeau">
        <a href="/website/index.php" class="gauche">Accueil</a>
        <a href="/website/profil.php" class="gauche">Profil</a>
        <a href="/website/login/" class="droite">Se connecter</a>
        <a href="/website/register/" class="droite">S'inscrire</a>
        <br>
    </div>
    <?php
    include ('Library/bdd_library.php');	
	
    // Connexion à la BDD
    $pdo=ConnexionBDD();
    $id = htmlspecialchars($_GET['genre']);
    $desc = htmlspecialchars($_GET['texting']);

    if ($pdo != NULL and $id != NULL and $desc != NULL) {
        try {
            // Use prepared statements for security
            $stmt = $pdo->prepare('INSERT INTO equipement (type, date_enr, description) VALUES (?, CURRENT_DATE, ?)');
            $stmt->execute([$id, $desc]);

            echo "<h1>Entrée de " . $id . " et de " . $desc . " effectuée avec succès</h1>";
        } catch (PDOException $e) {
            echo "<h1>Erreur lors de l'insertion : " . $e->getMessage() . "</h1>";
        }
    }
    else {
        echo "<h1> certains champs ne sont pas remplis</h1>";
    }
    ?>
</body>
</html>