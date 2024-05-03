<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
</head>
<body>
    <div class='bandeau'>
        <a href='/website/index.php' class='gauche'>Accueil</a>
        <a href='/website/profil.php' class='gauche'>Profil</a>
    <?php
    include ('Library/bdd_library.php');
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (IsLogged() != true) {
        echo "<a href='/website/login/' class='droite'>Se connecter</a>";
        echo "<a href='/website/register/' class='droite'>S'inscrire</a>";
    }
        echo "<br>";
    
    echo "</div>";
    echo "<div class='pdtop'>";
    $targetdir = getcwd()."/user/".$_SESSION["idd"]."/image/";
    $targetfile = $targetdir.basename($_FILES["fileupload"]["name"]);
    $uploadok = 1;
    $imageFileType = strtolower(pathinfo($targetfile,PATHINFO_EXTENSION));
    //Fausse image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
        if($check !== false) {
            echo "Le fichier est bien une image - " . $check["mime"]. ". <br>";
            $uploadok = 1;
        }
        else {
            echo "Le fichier n'est pas une image.<br>";
            $uploadok = 0;
        }
    }
    if(file_exists($targetfile)) {
        echo "Désolé, ce fichier existe déjà.<br>";
        $uploadok = 0;
    }
    if($_FILES["fileupload"]["size"] > 500000) {
        echo "Désolé, ton fichier est trop lourd.<br>";
        $uploadok = 0;
    }
    if($imageFileType != "jpg" and $imageFileType != "png" and $imageFileType != "jpeg" and $imageFileType != "gif" and $imageFileType != "jfif") {
        echo "Désolé, nous n'acceptons pas ce format d'image.<br>";
        $uploadok = 0;
    }
    if($uploadok == 0) {
        echo "<p>Ton fichier n'a pas été envoyé.<br></p>";
    }
    else {
        if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $targetfile)) {
            echo "Le fichier ". htmlspecialchars(basename($_FILES["fileupload"]["name"]). " a bien été enregistré <br>");
        }
        else {
            echo "Désolé, erreur lors de l'envoi<br>";
        }
    }
    echo "</div>";
    ?>
</body>
</html>