<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation modification d'information</title>
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
    <h1>Page de modification</h1>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include("Library/bdd_library.php");
    session_start();
    $pdo = ConnexionBDD();
    
    $idd = $_SESSION['idd'];
    $username = $_SESSION['username'];
    $surname = htmlspecialchars($_POST["surname"]);
    $first_name = htmlspecialchars($_POST["first_name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);

    
    if ($pdo != null) {
        try {
            $stmt = $pdo->prepare('UPDATE user SET mail = ?, phone = ?, first_name = ?, surname = ? WHERE id = ?');
            $stmt ->execute([$email, $phone, $first_name, $surname, $_SESSION['idd']]);
            LoadInfo($idd, $username, $surname, $first_name, $phone, $email);
            echo '<p>Modification effectué avec succès</p>';
        }catch(PDOException $e) {
            echo  'erreur'.$e->getMessage();
        }
    }
    ?>
</body>
</html>