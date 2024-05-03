<?php


//Connection a la base
function ConnexionBDD()
{
	try{
		
		$header = new PDO("mysql:host=localhost".";dbname=park","dbadm","Y^J29bjySf{6U69x");
			
		//echo"Connexion établie ".$host." BDD=".$nomBDD."<br>";
		return $header;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
		return null;
	}
}

// Requete select
function SelectBDD($header, $requete)
{
	$select = $header->prepare ($requete);
	$select->setFetchMode(PDO::FETCH_ASSOC);
	$select->execute();
	$recupdata=$select->fetchAll();
	
	return $recupdata;
}

function Login($username,$password) {
	if ($username !=null and $password !=null) {
		//Connexion à la BDD
        $pdo = ConnexionBDD();
        if ($pdo != null) {
			//Recupération de la table
            $stmt = $tableauSQL = SelectBDD($pdo, "SELECT * FROM user");
            for ($i=0;$i<count($stmt);$i++) {
				//Initialisation de variable de vérification de mot de passe
                $verify = password_verify($password, $stmt[$i]['password']);
                $active = $stmt[$i]['active'];
				//Verification des information
                if ($stmt[$i]['username'] == $username and $active == 1 and $verify) {
					//Connexion a la session.
                    //Initialisation de variable
					$idd = $stmt[$i]['id'];
					$phone = $stmt[$i]['phone'];
					$surname = $stmt[$i]['surname'];
					$first_name = $stmt[$i]['first_name'];
					$email = $stmt[$i]['mail'];
					//Entrée des variables dans la session
					$_SESSION['username'] = $username;
					$_SESSION['idd'] = $idd;
					$_SESSION['phone'] = $phone;
					$_SESSION['surname'] = $surname;
					$_SESSION['first_name'] = $first_name;
					$_SESSION['email'] = $email;
					//Afficher que la connexion est un succès.
					return true;
                }
            }     
        }
    }
}
function IsLogged() {
	if (!empty($_SESSION['username'])) {
		return true;
	}
	else {
		return false;
	}
}

function LoadInfo($idd, $username, $surname, $first_name, $phone, $email) {
	$_SESSION['username'] = $username;
	$_SESSION['idd'] = $idd;
	$_SESSION['phone'] = $phone;
	$_SESSION['surname'] = $surname;
	$_SESSION['first_name'] = $first_name;
	$_SESSION['email'] = $email;
}

function Register($username, $password, $email) {
	if(!empty($username) and !empty($password)) {
		$pdo=ConnexionBDD();
		$TableauSQL = SelectBDD($pdo, "SELECT * FROM user");
		for($i=0; $i<count($TableauSQL);$i++) {
			if($username == $TableauSQL[$i]['username']) {
				return 1;
			}
		}
		if ($pdo != NULL) {
			try {
				$stmt = $pdo->prepare('INSERT INTO user (username, mail, password, creation_date, active) VALUE (?, ?, ?, CURRENT_DATE, 1)');
				$stmt->execute([$username, $email, $password]);
				return 0;
			}catch(PDOException $e) {
				return 'erreur'. $e->getMessage();}
		}
	}
	else {
		return 2;
	}
}
?>