<hr>
<table id="table-orders">
    <caption>Prehľad objednávok obedov</caption>
    <thead>
        <tr>
            <th colspan="5">
                <input type="text" placeholder="filtrovať..." size="50" oninput="filterTable('table-orders', this.value)">
            </th>
        </tr>
        <tr>
            <th>Názov jedla</th>
            <th>Cena</th>
            <th>Dátum obedu</th>
            <th>Čas a dátum objednania</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($orders as $order)
{
    $id = $order['id'];
    
    echo("<tr>\n");

    echo("<td>{$order['meal_name']}</td>\n");
    echo("<td>{$order['meal_price']} &euro;</td>\n");
    echo("<td>{$order['menu_idem_date']}</td>\n");
    echo("<td>{$order['timestamp']}</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"deleteOrder($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("</tr>\n");
}

?>
    </tbody>
</table>