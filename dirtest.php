<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    $directory = "/var/www/html/website/user/".$_SESSION['idd']."/image";
    if (is_dir($directory)) {
        if ($dh = opendir($directory)){
            while (($file = readdir($dh)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                echo $file. "<br>";
            }
            closedir($dh);
        }
    }
    ?>
</body>
</html>