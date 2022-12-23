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
    
    html_echo("<tr>\n");

    html_echo("<td>{$order['meal_name']}</td>\n");
    html_echo("<td>{$order['meal_price']} &euro;</td>\n");
    html_echo("<td>{$order['menu_idem_date']}</td>\n");
    html_echo("<td>{$order['timestamp']}</td>\n");

    html_echo("<td>\n");
    html_echo("<button onclick=\"deleteOrder($id)\">Vymazať</button>\n");
    html_echo("</td>\n");

    html_echo("</tr>\n");
}

?>
    </tbody>
</table>