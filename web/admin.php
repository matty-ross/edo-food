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
        <title>Edo-Food | Admin</title>
    </head>
    <body>
<?php

if (!is_admin_logged_in($db))
{
    $goto = basename(__FILE__);
    echo("
        <script>
            alert('Nemáte administrátorske oprávnenia.');
            window.location = 'login.php?goto=$goto';
        </script>
    ");
}
else
{
?>
        <button onclick="logout()">Odhlásiť sa</button>
        <h1>Admin</h1>
        <nav>
            <div>
                <a href="javascript:showPeople()">Prehľad stravníkov</a>
            </div>
            <div>
                <a href="javascript:showMeals()">Prehľad jedál</a>
            </div>
            <div>
                <a href="#">Menu</a>
            </div>
        </nav>
        <output id="admin-settings"></output>
<?php
}
?>
    </body>
</html>