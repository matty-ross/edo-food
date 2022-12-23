<hr>
<div>
    <form method="get">
        <input type="date" id="date" name="date" value="<?php html_echo($date); ?>" oninput="this.form.submit()">
        <input type="hidden" name="page" value="menu-items">
    </form>
</div>
<hr>
<div id="add-menu-item-form">
    <h2>Pridať položku do menu</h2>
    <div>
        <select id="meal-id">
<?php

foreach ($soups as $soup)
{
    html_echo("<option value=\"{$soup['id']}\">{$soup['name']}</option>\n");
}
foreach ($main_dishes as $main_dish)
{
    html_echo("<option value=\"{$main_dish['id']}\">{$main_dish['name']}</option>\n");
}

?>
        </select>
    </div>
    <div>
        <button onclick="addMenuItem()">Pridať</button>
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
            <th>Alergény</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

$i = 1;
foreach ($menu_soups as $menu_soup)
{
    $id = $menu_soup['id'];

    html_echo("<tr>\n");

    html_echo("<td>$i</td>\n");
    html_echo("<td>{$menu_soup['meal_name']}</td>\n");
    html_echo("<td>{$menu_soup['meal_amount']} l</td>\n");
    html_echo("<td>{$menu_soup['meal_price']} &euro;</td>\n");

    $allergens = [];
    foreach ($menu_soup['meal_allergens'] as $allergen)
    {
        $allergens[] = $allergen['name'];
    }
    $allergens = implode(', ', $allergens);
    html_echo("<td>$allergens</td>\n");
    
    html_echo("<td>\n");
    html_echo("<button onclick=\"deleteMenuItem($id)\">Vymazať</button>\n");
    html_echo("</td>\n");

    html_echo("</tr>\n");

    ++$i;
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
            <th>Alergény</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

$i = 1;
foreach ($menu_main_dishes as $menu_main_dish)
{
    $id = $menu_main_dish['id'];
    
    html_echo("<tr>\n");

    html_echo("<td>$i</td>\n");
    html_echo("<td>{$menu_main_dish['meal_name']}</td>\n");
    html_echo("<td>{$menu_main_dish['meal_amount']} g</td>\n");
    html_echo("<td>{$menu_main_dish['meal_price']} &euro;</td>\n");

    $allergens = [];
    foreach ($menu_main_dish['meal_allergens'] as $allergen)
    {
        $allergens[] = $allergen['name'];
    }
    $allergens = implode(', ', $allergens);
    html_echo("<td>$allergens</td>\n");

    html_echo("<td>\n");
    html_echo("<button onclick=\"deleteMenuItem($id)\">Vymazať</button>\n");
    html_echo("</td>\n");

    html_echo("<tr>\n");

    ++$i;
}

?>
    </tbody>
</table>