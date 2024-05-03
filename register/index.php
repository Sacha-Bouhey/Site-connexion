<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
    <script type="text/javascript" src="/website/Library/script.js"></script>
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
        
        echo "<h1>Bienvenue sur la page d'inscription</h1>";
        echo "<div>";
            echo "<form method='POST' onsubmit='return checkPasswordMatch();' id='registrationForm'>";
                echo "<input type='text' name='username' placeholder='username'>";
                echo "<br>";
                echo "<input type='text' name='email' placeholder='mail address'>";
                echo "<br>";
                echo "<input type='password' name='password'>";
                echo "<br>";
                echo "<input type='password' name='password_conf'>";
                echo "<p id='notmatching'></p>";
                echo "<br>";
                echo "<button type='submit'>S'enregister</button>";
            echo "</form>";
        echo "</div>";


        if(isset($_POST["username"]) and isset($_POST["email"]) and isset($_POST["password"]) and isset($_POST["password_conf"])) {
            $username = htmlspecialchars($_POST["username"]);
            $email = htmlspecialchars($_POST["email"]);
            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
            $password_conf = htmlspecialchars($_POST["password_conf"]);
            
            if ($password != NULL and $password_conf != NULL) {
                if(Register($username, $password, $email) == 0) {
                    echo "<p>Utilisateur enregistré avec succès.</p>";
                }
                elseif(Register($username, $password, $email) == 1) {
                    echo "<p>Le nom d'utilisateur est déjà existant.</p>";
                }
                elseif(Register($username, $password, $email) == 2) {
                    echo "<p>Merci de remplir tous les champs requis.</p>";
                }
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