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


$logged_in_person = $db->get_person(get_logged_in_user($db));

$date = $_GET['date'] ?? null;
$date = is_valid_date($date) ? $date : date('Y-m-d');

$menu_soups = $db->get_menu_items($date, 'soup');
$menu_main_dishes = $db->get_menu_items($date, 'main_dish');
$orders = $db->get_user_orders($logged_in_person['id']);

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
        <link rel="stylesheet" href="./css/main.css">
        <script src="./js/communication.js" defer></script>
        <title>Edo-Food | Menu</title>
    </head>
    <body>
        <div class="user-info">
            <span>
                <p><?php echo($logged_in_person['full_name']); ?></p>
                <p><?php echo($logged_in_person['email']); ?></p>
            </span>
            <span>
                <button onclick="logout()">Odhlásiť sa</button>
            </span>
        </div>
        <nav>
            <a href="?page=menu-items">Menu</a>
            <a href="?page=orders">Prehľad objednávok</a>
        </nav>
        <main>
            <h1>Menu</h1>
<?php

$page = $_GET['page'] ?? null;
switch ($page)
{
    case 'menu-items':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/menu/menu-items.php';
        break;
    }

    case 'orders':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/menu/orders.php';
        break;
    }
}

?>
        </main>
    </body>
</html>