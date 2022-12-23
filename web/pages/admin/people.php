<hr>
<div id="add-person-form" class="add-item-form">
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
<table id="table-people">
    <caption>Prehľad stravníkov</caption>
    <thead>
        <tr>
            <th colspan="7">
                <input type="text" placeholder="filtrovať..." size="50" oninput="filterTable('table-people', this.value)">
            </th>
        </tr>
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
    
    html_echo("<tr>\n");
    
    html_echo("<td>\n");
    html_echo("<input type=\"number\" id=\"person-id-$id\" value=\"{$person['id']}\" oninput=\"\">\n");
    html_echo("</td>\n");

    html_echo("<td>\n");
    html_echo("<input type=\"text\" id=\"person-full-name-$id\" value=\"{$person['full_name']}\" size=\"30\">\n");
    html_echo("</td>\n");

    html_echo("<td>\n");
    html_echo("<input type=\"email\" id=\"person-email-$id\" value=\"{$person['email']}\" size=\"30\">\n");
    html_echo("</td>\n");

    html_echo("<td>\n");
    html_echo("<input type=\"text\" id=\"person-change-password-$id\" placeholder=\"nové heslo...\" size=\"30\">\n");
    html_echo("</td>\n");

    html_echo("<td>\n");
    html_echo("<div>{$person['credit']} &euro;</div>\n");
    html_echo("<input type=\"number\" id=\"person-add-credit-$id\" placeholder=\"pridať krediť...\">\n");
    html_echo("</td>\n");
    
    html_echo("<td>\n");
    $checked = $person['admin'] === 'Y' ? 'checked' : '';
    html_echo("<input type=\"checkbox\" id=\"person-admin-$id\" $checked>\n");
    html_echo("</td>\n");

    html_echo("<td>\n");
    html_echo("<button onclick=\"updatePerson($id)\">Upraviť</button>\n");
    html_echo("<button onclick=\"deletePerson($id)\">Vymazať</button>\n");
    html_echo("</td>\n");

    html_echo("</tr>\n");
}

?>
    </tbody>
</table>