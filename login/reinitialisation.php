<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
    <script type="text/javascript" src="/website/Library/script.js"></script>
    <title>Réinitialisation</title>
</head>
<body>
<div class='bandeau'>
        <a href='/website/index.php' class='gauche'>Accueil</a>
        <a href='/website/profil.php' class='gauche'>Profil</a>
    <?php 
    session_start();
    include ('/var/www//html/website/Library/bdd_library.php');	
    if (IsLogged() != true) {
            echo "<a href='/website/login/' class='droite'>Se connecter</a>";
            echo "<a href='/website/register/' class='droite'>S'inscrire</a>";
            echo "<br>";
        
        echo "</div>";
        //affiche les erreurs
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        //initialisation de mes variables
        $reinitalisation = htmlspecialchars($_GET['token']);
        $pdo = ConnexionBDD();
        //préparation de la requete sql
        $stmt = $pdo->prepare('SELECT * FROM password_reset WHERE PasswordResetExpiration BETWEEN (DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR)) AND CURRENT_TIMESTAMP AND PasswordResetToken = ?');
        //insertion de ma variable dans ma requete
        $stmt->execute([$reinitalisation]);

        if ($stmt->rowCount() != 0) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Extract the value of 'username' column
            $uname = $row['username'];
            echo "<form onsubmit='return checkPasswordMatch();' method='post'>";
            echo "<input type='password' name='password'>";
            echo "<br>";
            echo "<input type='password' name='password_conf'>";
            echo "<p id='notmatching'></p>";
            echo "<br>";
            echo "<button type='submit'>Modifier le mot de passe</button>";

            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);

            $stmt = $pdo->prepare('UPDATE user SET password = ? where username = ?');
            $stmt->execute([$password,$uname]);
        }
    }
        ?>