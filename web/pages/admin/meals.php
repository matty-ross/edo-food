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
        <select id="allergens" data-placeholder="Alergény..." multiple>
<?php

foreach ($allergens as $allergen)
{
    echo("<option value=\"{$allergen['id']}\">{$allergen['name']}</option>\n");
}

?>
        </select>
    </div>
    <div>
        <button onclick="addMeal()">Pridať</button>
    </div>
</div>
<hr>
<div id="add-allergen-form">
    <h2>Pridať alergén</h2>
    <div>
        <input type="text" id="allergen-name" placeholder="Názov...">
    </div>
    <div>
        <button onclick="addAllergen()">Pridať</button>
    </div>
</div>
<hr>
<table id="table-soups">
    <caption>Prehľad polievok</caption>
    <thead>
        <tr>
            <th colspan="5">
                <input type="text" placeholder="filtrovať..." size="50" oninput="filterTable('table-soups', this.value)">
            </th>
        </tr>
        <tr>
            <th>Názov polievky</th>
            <th>Cena (&euro;)</th>
            <th>Objem (l)</th>
            <th>Alergény</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($soups as $soup)
{
    $id = $soup['id'];
    $soup_allergen_ids = [];
    foreach ($soup['allergens'] as $soup_allergen)
    {
        $soup_allergen_ids[] = $soup_allergen['id'];
    }
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("<input type=\"text\" id=\"meal-name-$id\" value=\"{$soup['name']}\" size=\"60\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-price-$id\" value=\"{$soup['price']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-amount-$id\" value=\"{$soup['amount']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<select id=\"meal-allergens-$id\" multiple>\n");
    foreach ($allergens as $allergen)
    {
        $selected = in_array($allergen['id'], $soup_allergen_ids) ? 'selected' : '';
        echo("<option value=\"{$allergen['id']}\" $selected>{$allergen['name']}</option>\n");
    }
    echo("</select>\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updateMeal($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deleteMeal($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("</tr>\n");
}

?>
    </tbody>
</table>
<hr>
<table id="table-main-dishes">
    <caption>Prehľad hlavných jedál</caption>
    <thead>
        <tr>
            <th colspan="5">
                <input type="text" placeholder="filtrovať..." size="50" oninput="filterTable('table-main-dishes', this.value)">
            </th>
        </tr>
        <tr>
            <th>Názov jedla</th>
            <th>Cena (&euro;)</th>
            <th>Hmotnosť (g)</th>
            <th>Alergény</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($main_dishes as $main_dish)
{
    $id = $main_dish['id'];
    $main_dish_allergen_ids = [];
    foreach ($main_dish['allergens'] as $main_dish_allergen)
    {
        $main_dish_allergen_ids[] = $main_dish_allergen['id'];
    }
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("<input type=\"text\" id=\"meal-name-$id\" value=\"{$main_dish['name']}\" size=\"60\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-price-$id\" value=\"{$main_dish['price']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"number\" id=\"meal-amount-$id\" value=\"{$main_dish['amount']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<select id=\"meal-allergens-$id\" multiple>\n");
    foreach ($allergens as $allergen)
    {
        $selected = in_array($allergen['id'], $main_dish_allergen_ids) ? 'selected' : '';
        echo("<option value=\"{$allergen['id']}\" $selected>{$allergen['name']}</option>\n");
    }
    echo("</select>\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updateMeal($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deleteMeal($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("</tr>\n");
}

?>
    </tbody>
</table>
<hr>
<table id="table-allergens">
    <caption>Prehľad alergénov</caption>
    <thead>
        <tr>
            <th colspan="3">
                <input type="text" placeholder="filtrovať..." size="50" oninput="filterTable('table-allergens', this.value)">
            </th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Názov</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($allergens as $allergen)
{
    $id = $allergen['id'];
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("{$allergen['id']}\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"text\" id=\"allergen-name-$id\" value=\"{$allergen['name']}\" size=\"30\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updateAllergen($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deleteAllergen($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("</tr>\n");
}

?>
    </tbody>
</table>