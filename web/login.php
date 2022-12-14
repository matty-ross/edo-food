<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/utility.php';

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
        <link rel="stylesheet" href="./css/main.css">
        <script src="./js/communication.js" defer></script>
        <title>Edo-Food | Login</title>
    </head>
    <body>
        <div id="login-form">
            <div>
                <input type="email" id="email" placeholder="Email..." size="30">
            </div>
            <div>
                <input type="password" id="password" placeholder="Heslo..." size="30">
            </div>
            <input type="hidden" id="goto" value="<?php html_echo($_GET['goto'] ?? './menu.php'); ?>">
            <div>
                <button onclick="login(null)">Prihlásiť sa</button>
            </div>
        </div>
        <script>
            {
                const host = "<?php html_echo($config['ws_host']); ?>";
                const port = <?php html_echo($config['ws_port']); ?>;
                const ws = new WebSocket(`ws://${host}:${port}`);
                ws.onmessage = (event) => {
                    login(event.data);
                }
            }
        </script>
    </body>
</html>