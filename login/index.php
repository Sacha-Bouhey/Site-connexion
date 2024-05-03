<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
    <script type="text/javascript" src="/website/Library/script.js"></script>
    <title>Login</title>
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
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        

        echo"<div id='profile'>";
            echo "<form method='post'>";
            echo "<br>";
            echo "<input type='text' name='username' placeholder='username'>";
            echo "<br>";
            echo "<input type='password' name='password'>";
            echo "<br>";
            echo "<button type='submit'>Se connecter</button><br>";
            echo "<a href='forgotpass.php'>Mot de passe oublié ?</a>";
            echo "</form>";
        echo "</div>";

        if (isset($_POST['username']) and isset($_POST['password'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            Login($username,$password);
            if (Login($username,$password)) {
                echo "<p>Connexion réussie !</p>";
                echo '<script type="text/javascript">modifpage()</script>';
            }
            else {
                echo "<p>identifiants incorrects</p>";
            }
        }
    }
    else {
        echo "<br>";
        echo "</div>";
        echo "<h1>Vous êtes déjà connecté.</h1>";
    }
    ?>
</body>
</html>