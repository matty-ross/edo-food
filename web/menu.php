<?php

require 'functions/db.php';
require 'functions/utility.php';

session_start();

$db = new Database();

?>
<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/communication.js" defer></script>
        <title>Edo-Food | Menu</title>
    </head>
    <body>
<?php

if (!is_user_logged_in($db))
{
    $goto = basename(__FILE__);
    echo("
        <script>
            alert('Nie ste prihlásený.');
            window.location = 'login.php?goto=$goto';
        </script>
    ");
}
else
{
?>
        <button onclick="logout()">Odhlásiť sa</button>
        <h1>Menu</h1>
<?php
}
?>
    </body>
</html>