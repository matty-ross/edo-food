<?php

require_once 'functions/db.php';

$db = new Database();
$soups = $db->get_meals('soup');
$menu_soups = $db->get_menu_items(null, 'soup');
$main_dishes = $db->get_meals('main_dish');
$menu_main_dishes = $db->get_menu_items(null, 'main_dish');

?>
<hr>
<div>
    <input type="date">
</div>
<hr>
<div id="add-menu-item-form">
    <h2>Pridať položku do menu</h2>
    <div>
        <select id="meal-id">
<?php

foreach ($soups as $soup)
{
    echo("<option value=\"{$soup['id']}\">{$soup['name']}</option>\n");
}
foreach ($main_dishes as $main_dish)
{
    echo("<option value=\"{$main_dish['id']}\">{$main_dish['name']}</option>\n");
}

?>
        </select>
    </div>
</div>
<hr>
<table>
    <caption>Prehľad polievok v menu</caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Názov polievky</th>
            <th>Objem</th>
            <th>Cena</th>
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

    echo("<tr>\n");
}

?>
    </tbody>
</table>
<hr>
<table>
    <caption>Prehľad hlavných jedál v menu</caption>
    <thead>
        <tr>
            <th>#</th>
            <th>Názov hlavného jedla</th>
            <th>Hmotnosť</th>
            <th>Cena</th>
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
    echo("<td>{$menu_main_dish['meal_amount']} g</td>\n");
    echo("<td>{$menu_main_dish['meal_price']} &euro;</td>\n");

    echo("<tr>\n");
}

?>
    </tbody>
</table>