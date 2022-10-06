<?php

require_once 'functions/db.php';

$user_id = $_SESSION['user-id'] ?? null;

$db = new Database();
if ($db->is_valid_user_id($user_id))
{
    $orders = $db->get_user_orders($user_id);
}
else
{
    $orders = [];
}

?>
<table>
    <caption>Prehľad objednávok obedov</caption>
    <thead>
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