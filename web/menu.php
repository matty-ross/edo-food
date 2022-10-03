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
        <form method="get">
            <input type="date" name="date" value="<?php echo($date); ?>" oninput="this.form.submit()">
        </form>
        <nav>
            <div>
                <a href="?page=menu-items">Menu</a>
            </div>
            <div>
                <a href="?page=orders">Prehľad objednávok</a>
            </div>
        </nav>
<?php

    $page = $_GET['page'] ?? null;
    switch ($page)
    {
    case 'menu-items':
        include 'pages/menu/menu-items.php';
        break;

    case 'orders':
        include 'pages/menu/orders.php';
        break;
    }
}

?>
    </body>
</html>