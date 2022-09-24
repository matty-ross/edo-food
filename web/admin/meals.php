<?php

require '../functions/db.php';

$db = new Database();
$soups = $db->get_meals('soup');
$main_dishes = $db->get_meals('main_dish');

?>
<hr>
<div id="add-meal-form">
    <h2>Pridať jedlo</h2>
    <div>
        <input type="text" id="name" placeholder="Názov...">
    </div>
    <div>
        <input type="number" id="price" placeholder="Cena (€)...">
    </div>
    <div>
        <input type="number" id="amount" placeholder="Objem (l) alebo hmotnosť (g)...">
    </div>
    <div>
        <select id="meal-type">
            <option value="soup">Polievka</option>
            <option value="main_dish">Hlavné jedlo</option>
        </select>
    </div>
    <div>
        <button onclick="addMeal()">Pridať</button>
    </div>
</div>
<hr>
<table>
    <caption>Prehľad polievok</caption>
    <thead>
        <tr>
            <th>Názov polievky</th>
            <th>Cena (&euro;)</th>
            <th>Objem (l)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($soups as $soup)
{
    $id = $soup['id'];
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("<input type=\"text\" id=\"meal-name-$id\" value=\"{$soup['name']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-price-$id\" value=\"{$soup['price']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-amount-$id\" value=\"{$soup['amount']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updateMeal($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deleteMeal($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("<tr>\n");
}

?>
    </tbody>
</table>
<hr>
<table>
    <caption>Prehľad hlavných jedál</caption>
    <thead>
        <tr>
            <th>Názov jedla</th>
            <th>Cena (&euro;)</th>
            <th>Hmotnosť (g)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($main_dishes as $main_dish)
{
    $id = $main_dish['id'];
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("<input type=\"text\" id=\"meal-name-$id\" value=\"{$main_dish['name']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-price-$id\" value=\"{$main_dish['price']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-amount-$id\" value=\"{$main_dish['amount']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updateMeal($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deleteMeal($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("<tr>\n");
}

?>
    </tbody>
</table>