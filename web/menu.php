<?php

require_once 'functions/db.php';
require_once 'functions/utility.php';

session_start();

$date = $_GET['date'] ?? null;
$date = is_valid_date($date) ? $date : date('Y-m-d');

$db = new Database();
$menu_soups = $db->get_menu_items($date, 'soup');
$menu_main_dishes = $db->get_menu_items($date, 'main_dish');

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
        <table>
            <caption>Polievky</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Názov</th>
                    <th>Objem</th>
                    <th>Cena</th>
                    <th>Alergény</th>
                </tr>
            </thead>
            <tbody>
<?php

$i = 1;
foreach ($menu_soups as $menu_soup)
{
    echo("<tr>\n");

    echo("<td>$i</td>\n");
    echo("<td>{$menu_soup['meal_name']}</td>\n");
    echo("<td>{$menu_soup['meal_amount']} l</td>\n");
    echo("<td>{$menu_soup['meal_price']} &euro;</td>\n");

    $allergens = [];
    foreach ($menu_soup['meal_allergens'] as $allergen)
    {
        $allergens[] = $allergen['name'];
    }
    $allergens = implode(', ', $allergens);
    echo("<td>$allergens</td>\n");

    echo("</tr>\n");

    ++$i;
}

?>
            </tbody>
        </table>
        <table>
            <caption>Hlavné jedlá</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Názov</th>
                    <th>Objem</th>
                    <th>Cena</th>
                    <th>Alergény</th>
                </tr>
            </thead>
            <tbody>
<?php

$i = 1;
foreach ($menu_main_dishes as $menu_main_dish)
{
    echo("<tr>\n");

    echo("<td>$i</td>\n");
    echo("<td>{$menu_main_dish['meal_name']}</td>\n");
    echo("<td>{$menu_main_dish['meal_amount']} l</td>\n");
    echo("<td>{$menu_main_dish['meal_price']} &euro;</td>\n");

    $allergens = [];
    foreach ($menu_main_dish['meal_allergens'] as $allergen)
    {
        $allergens[] = $allergen['name'];
    }
    $allergens = implode(', ', $allergens);
    echo("<td>$allergens</td>\n");

    echo("</tr>\n");

    ++$i;
}

?>
            </tbody>
        </table>
<?php
}
?>
    </body>
</html>