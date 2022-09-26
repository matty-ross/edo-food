<?php

require_once 'functions/db.php';

$db = new Database();
$soups = $db->get_meals('soup');
$menu_soups = $db->get_menu_items(null, 'soup');
$main_dishes = $db->get_meals('main_dish');
$menu_main_dishes = $db->get_menu_items(null, 'main_dish');

?>
<hr>
<table>
    <caption>Prehľad polievok v menu</caption>
    <thead>
        <tr>
            <th>Názov polievky</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($menu_soups as $menu_soup)
{
    echo("<tr>\n");

    echo("<td>\n");
    echo("<select>\n");
    foreach ($soups as $soup)
    {
        echo("<option value=\"{$soup['id']}\">{$soup['name']}</option>\n");
    }
    echo("</select>\n");
    echo("</td>\n");

    echo("<tr>\n");
}

?>
    </tbody>
</table>