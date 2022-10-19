<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/authentification.php';


session_start();

$db = new Database();

if (!authentificate_admin($db))
{
    header('Location: ./login.php?goto=./admin.php');
    die;
}


$date = $_GET['date'] ?? null;
$date = is_valid_date($date) ? $date : date('Y-m-d');

$soups = $db->get_meals('soup');
$menu_soups = $db->get_menu_items($date, 'soup');
$main_dishes = $db->get_meals('main_dish');
$menu_main_dishes = $db->get_menu_items($date, 'main_dish');
$allergens = $db->get_allergens();
$people = $db->get_people();

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
        <title>Edo-Food | Admin</title>
    </head>
    <body>
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
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/people.php';
        break;
    }

case 'meals':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/meals.php';
        break;
    }

case 'menu-items':
    {
        include $_SERVER['DOCUMENT_ROOT'] . '/pages/admin/menu-items.php';
        break;
    }
}

?>
    </body>
</html>