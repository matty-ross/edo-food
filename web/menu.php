<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/authentification.php';


session_start();

$db = new Database();

if (!authentificate_user($db))
{
    header('Location: ./login.php?goto=./menu.php');
    die;
}


$date = $_GET['date'] ?? null;
$date = is_valid_date($date) ? $date : date('Y-m-d');

$menu_soups = $db->get_menu_items($date, 'soup');
$menu_main_dishes = $db->get_menu_items($date, 'main_dish');
$orders = $db->get_user_orders(get_logged_in_user($db));

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
        <script src="./js/communication.js" defer></script>
        <title>Edo-Food | Menu</title>
    </head>
    <body>
        <button onclick="logout()">Odhlásiť sa</button>
        <h1>Menu</h1>
        <nav>
            <div>
                <a href="?page=menu-items">Menu</a>
            </div>
            <div>
                <a href="?page=orders">Prehľad objednávok</a>
            </div>
        </nav>
<?php

$page = $_GET['page'] ?? null;
switch ($page)
{
case 'menu-items':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/menu/menu-items.php';
    }
    break;

case 'orders':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/menu/orders.php';
    }
    break;
}

?>
    </body>
</html>