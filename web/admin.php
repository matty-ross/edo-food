<?php

require_once 'functions/db.php';
require_once 'functions/utility.php';

session_start();

$db = new Database();

?>
<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
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
                <a href="?page=people">Prehľad stravníkov</a>
            </div>
            <div>
                <a href="?page=meals">Prehľad jedál</a>
            </div>
            <div>
                <a href="?page=menu-items">Menu</a>
            </div>
        </nav>
<?php

    $page = $_GET['page'] ?? null;
    switch ($page)
    {
    case 'people':
        include 'pages/admin/people.php';
        break;

    case 'meals':
        include 'pages/admin/meals.php';
        break;

    case 'menu-items':
        include 'pages/admin/menu-items.php';
        break;
    }
}

?>
    </body>
</html>