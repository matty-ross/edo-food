<?php

require_once 'functions/db.php';

$db = new Database();
$people = $db->get_people();

?>
<hr>
<div id="add-person-form">
    <h2>Pridať stravníka</h2>
    <div>
        <input type="number" id="id" placeholder="ID...">
    </div>
    <div>
        <input type="text" id="full-name" placeholder="Celé meno...">
    </div>
    <div>
        <input type="email" id="email" placeholder="Email...">
    </div>
    <div>
        <input type="text" id="password" placeholder="Heslo...">
    </div>
    <div>
        <input type="number" id="credit" placeholder="Kredit...">
    </div>
    <div>
        <label for="admin">Admin</label>
        <input type="checkbox" id="admin">
    </div>
    <div>
        <button onclick="addPerson()">Pridať</button>
    </div>
</div>
<hr>
<table>
    <caption>Prehľad stravníkov</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Celé meno</th>
            <th>Email</th>
            <th>Zmena hesla</th>
            <th>Kredit</th>
            <th>Admin</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($people as $person)
{
    $id = $person['id'];
    
    echo("<tr>\n");
    
    echo("<td>\n");
    echo("<input type=\"number\" id=\"person-id-$id\" value=\"{$person['id']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"text\" id=\"person-full-name-$id\" value=\"{$person['full_name']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"email\" id=\"person-email-$id\" value=\"{$person['email']}\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<input type=\"text\" id=\"person-change-password-$id\" placeholder=\"zmeniť heslo...\">\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<div>{$person['credit']} &euro;</div>\n");
    echo("<input type=\"number\" id=\"person-add-credit-$id\" placeholder=\"pridať krediť...\">\n");
    echo("</td>\n");
    
    echo("<td>\n");
    $checked = $person['admin'] === 'Y' ? 'checked' : '';
    echo("<input type=\"checkbox\" id=\"person-admin-$id\" $checked>\n");
    echo("</td>\n");

    echo("<td>\n");
    echo("<button onclick=\"updatePerson($id)\">Upraviť</button>\n");
    echo("<button onclick=\"deletePerson($id)\">Vymazať</button>\n");
    echo("</td>\n");

    echo("<tr>\n");
}

?>
    </tbody>
</table>