<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>entreebdd</title>
    <link rel="stylesheet" href="Library/stylesheet.css">
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
    $pdo = ConnexionBDD();
    $tableauSQL = SelectBDD($pdo, "SELECT * FROM type_equipement;");
    
    echo "<div class='entree'>";
        echo "<form action='enregistrement.php' method='GET'>";
            echo "<input type='text' placeholder='Description' name='texting'>";
            echo "<br>";
            echo "<select name='genre' id='genre_id'>";
                for ($i = 0; $i < count($tableauSQL); $i++) {
                    echo "<option value=".$tableauSQL[$i]['id'].">".$tableauSQL[$i]['nom_equipement']."</option>";
                }
            echo"</select>";
            echo '<br>';
            echo "<button class='equipsend' type='submit'>Envoyer</button>";
        echo "</form>";
    echo "</div>";

    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Type</th>';
    echo "<th>Date d'enregistrement</th>";
    echo '<th>Description</th>';
    echo '</tr>';
    $tableauSQL2 = SelectBDD($pdo, "SELECT equipement.id AS id_eqpm, equipement.type AS type, equipement.date_enr AS date_enr, equipement.description AS description, type_equipement.id, type_equipement.nom_equipement AS type_nom FROM equipement JOIN type_equipement ON type_equipement.id = equipement.type ;");

    for ($i = 0; $i < count($tableauSQL2); $i++) {
        echo '<tr>';
        echo '<td>'.$tableauSQL2[$i]['id_eqpm'].'</td>';
        echo '<td>'.$tableauSQL2[$i]['type_nom'].'</td>';
        echo '<td>'.$tableauSQL2[$i]['date_enr'].'</td>';
        echo '<td>'.$tableauSQL2[$i]['description'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>    
</body>
</html>
