<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script type="text/javascript" src="Library/script.js"></script>
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
</head>
<body>
    <div class='bandeau'>
        <a href='/website/index.php' class='gauche'>Accueil</a>
        <a href='/website/profil.php' class='gauche'>Profil</a>
    <?php 
    include ('Library/bdd_library.php');
    session_start();

    if (IsLogged() != true) {
        echo "<a href='/website/login/' class='droite'>Se connecter</a>";
        echo "<a href='/website/register/' class='droite'>S'inscrire</a>";
    }
        echo "<br>";
    
    echo "</div>";

    if (IsLogged()) {
        echo '<br>';
        echo "<br>";


        echo "<h1>Bienvenue<br>".$_SESSION['username']."</h1>";
        //Section image
        //Premier div = toute les images
        echo "<div class='profilecontainer'>";
        //Image principale
            echo "<div>";
                echo "<img class='profileimage' src='user/".$_SESSION['idd']."/image/logo.png'>";
            echo "</div>";
                //les images sur le côté
                echo "<div class='imagecontainer'>";
                    //image individuel
                    echo "<div class='smallimage'>";
                        echo "<img class='profileimage' src='user/".$_SESSION['idd']."/image/logos.png'>";
                    echo "</div>";
                    //image individuel
                    echo "<div>";
                    echo "</div>";
                    //image individuel
                    echo "<div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";

        echo "<br>";
        echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='file' name='fileupload' accept='.jpeg,.png,.jpg,.jfif,.gif'>";
        echo "<input type='submit' value='Upload Image' name='submit'>";
        echo "</form>";
        echo "<br>";

            echo "<div id='profile'>";
                echo "<p>Votre nom: </p>";
                //Je vérifie qu'il y ai une info enregistré si il n'y en a pas = pas d'info si y'en a une affiche l'info
                if (empty($_SESSION['surname'])){
                    echo "<p>Pas d'information enregisté</p>";
                }
                else{
                    echo "<p>".$_SESSION['surname']."</p>";
                }
                echo "<p>Votre prénom: </p>";
                //Je vérifie qu'il y ai une info enregistré si il n'y en a pas = pas d'info si y'en a une affiche l'info
                if (empty($_SESSION["first_name"])){
                    echo "<p>Pas d'information enregisté</p>";
                }
                else{
                    echo "<p>".$_SESSION["first_name"]."</p>";
                }
                echo "<p>Votre numéro de téléphone: </p>";
                //Je vérifie qu'il y ai une info enregistré si il n'y en a pas = pas d'info si y'en a une affiche l'info
                if (empty($_SESSION["phone"])){
                    echo "<p>Pas d'information enregisté</p>";
                }
                else{
                    echo "<p>".$_SESSION["phone"]."</p>";
                }
                echo "<p>Votre addresse email: </p>";
                //Je vérifie qu'il y ai une info enregistré si il n'y en a pas = pas d'info si y'en a une affiche l'info
                if (empty($_SESSION["email"])){
                    echo "<p>Pas d'information enregisté</p>";
                }
                else{
                    echo "<p>".$_SESSION["email"]."</p>";
                }

                echo "<button type='button' onclick='modifpage()'>Modifier les infos</button>";
            echo "</div>";

            echo "<div id='modif' hidden>";
                echo "<form method='post' action='confirmation.php'>";
                    echo "<p>Votre nom: </p>";
                    echo "<input type='text' name='surname' value=".$_SESSION['surname']."><br>";
                    echo "<p>Votre prénom: </p>";
                    echo "<input type='text' name='first_name' value=".$_SESSION['first_name']."><br>";
                    echo "<p>Votre numéro de téléphone: </p>";
                    echo "<input type='text' name='phone' value=".$_SESSION['phone']."><br>";
                    echo "<p>Votre addresse email: </p>";
                    echo "<input type='text' name='email' value=".$_SESSION['email']."><br>";
                    echo "<button type='submit'>Confirmer</button>";
                    echo "<button type='button' onclick='modifpagereverse()'>Annuler</button>";
                echo "</form>";
            echo "</div>";

            echo "Voulez-vous vous <a href='/website/logout.php'>déconnecter</a> ?";

        }
        else {
            echo"<p>Vous n'êtes pas connecté. Vous pouvez <a href='/website/register/'>créer un compte</a> ou <a href='/website/login/'>vous connectez</a></p>";
        }
    ?>
</body>
</html>