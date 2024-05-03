<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
    <script type="text/javascript" src="/website/Library/script.js"></script>
</head>
<body>
    <div class='bandeau'>
        <a href='/website/index.php' class='gauche'>Accueil</a>
        <a href='/website/profil.php' class='gauche'>Profil</a>
    <?php
    include ('/var/www//html/website/Library/bdd_library.php');	
    session_start();
    if (IsLogged() != true) {
        echo "<a href='/website/login/' class='droite'>Se connecter</a>";
        echo "<a href='/website/register/' class='droite'>S'inscrire</a>";
    }
        echo "<br>";
        
    echo "</div>";

    echo "<br>";

    echo "<div>";
        echo "<form method='post' action='confirm.php'>";
        echo "<input type='text' placeholder='username' name='username'>";
        echo "<br>";
        echo "<button type='submit'>Réinitialiser le mot de passe.</button>";
        echo "</form>";
    echo "</div>";
    ?>
</body>
</html>