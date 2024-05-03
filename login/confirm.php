<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de mot de passe</title>
    <link rel="stylesheet" href="/website/Library/stylesheet.css">
    <script type="text/javascript" src="/website/Library/script.js"></script>
</head>
<body>
    <div class='bandeau'>
        <a href='/website/index.php' class='gauche'>Accueil</a>
        <a href='/website/profil.php' class='gauche'>Profil</a>
    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    //Montrer les erreurs
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    function getRandomStringSha1($length = 32)
    {
        $string = sha1(rand());
        $randomString = substr($string, 0, $length);
        return $randomString;
    }
    

    require '/home/sacha/vendor/autoload.php';
  
    $reinitalisation = getRandomStringSha1();
    $mail = new PHPMailer(true);
    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.lolice.xyz';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sacha@lolice.xyz';                     //SMTP username
    $mail->Password   = 'DPX*jtx@wxm3hdx9ztu';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //port
    $mail->CharSet = "UTF-8";                                   //define charset

    //Inclure ma librairie
    include ('/var/www//html/website/Library/bdd_library.php');	
    //Démarre la session
    session_start();
    //Si l'utilisateur est connecté n'affiche pas se connecter et s'inscrire
    if (IsLogged() != true) {
        echo "<a href='/website/login/' class='droite'>Se connecter</a>";
        echo "<a href='/website/register/' class='droite'>S'inscrire</a>";
    }
        echo "<br>";
        
    echo "</div>";

    //Récupération des paramettres
    $uname = htmlspecialchars($_POST['username']);
    echo $uname;
    //Requete SQL 
    $pdo = ConnexionBDD();
    $stmt = $tableauSQL = SelectBDD($pdo, 'SELECT * FROM user');
    for ($i=0;$i<count($stmt);$i++) {
        if($stmt[$i]['mail'] != NULL and !empty($stmt[$i]['mail']) ){
            if($uname == $stmt[$i]['username']) {
                echo '<p>Mail de réinitialisation de mot de passe envoyé.</p>';
                $from = 'contact@lolice.xyz';
                $to = $stmt[$i]['mail'];
                $subject = 'Demande de réinitialisation de mot de passe';
                $message = 'Voici le lien de réinitialisation de mot de passe : https://www.lolice.xyz/website/login/reinitialisation.php?token='.$reinitalisation;
                $headers = 'De :'.$from;

                try {
                    $mail->setFrom($from, 'Support');
                    $mail->addAddress($to);
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->AltBody = $message;


                    $mail->send();
                    echo 'Message has been sent';
                    $stmt = $pdo->prepare('INSERT INTO password_reset (PasswordResetToken, PasswordResetExpiration, username) VALUES (?,current_timestamp, ?)');
                    $stmt->execute([$reinitalisation, $uname]);

                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    }


    ?>
</body>
</html>