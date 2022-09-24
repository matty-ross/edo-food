<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/communication.js" defer></script>
        <title>Edo-Food | Login</title>
    </head>
    <body>
        <div id="login-form">
            <div>
                <input type="email" id="email" placeholder="Email...">
            </div>
            <div>
                <input type="password" id="password" placeholder="Heslo...">
            </div>
            <input type="hidden" id="goto" value="<?php echo($_GET['goto'] ?? 'menu.php'); ?>">
            <div>
                <button onclick="login()">Prihlásiť sa</button>
            </div>
        </div>
    </body>
</html>