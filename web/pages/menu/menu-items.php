<hr>
<div>
    <form method="get">
        <input type="date" name="date" value="<?php echo($date); ?>" oninput="this.form.submit()">
        <input type="hidden" name="page" value="menu-items">
    </form>
</div>
<hr>
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
    $id = $menu_soup['id'];

    echo("<tr onclick=\"addOrder($id)\" style=\"cursor: pointer;\">\n");

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
<hr>
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
    $id = $menu_main_dish['id'];
    
    echo("<tr onclick=\"addOrder($id)\" style=\"cursor: pointer;\">\n");

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