<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/chosen.min.css">
    <script src="./vendor/jquery-3.6.1.min.js"></script>
    <script src="./vendor/chosen.jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <select id="test-chosen" multiple>
<?php

for ($i = 1; $i < 1000; ++$i)
{
    echo("<option>$i</option>\n");
}

?>
    </select>
    <script>
        $("#test-chosen").chosen();
    </script>
</body>
</html>