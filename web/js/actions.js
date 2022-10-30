jQuery.expr[":"].icontains = function(a, i, m) {
    return a.textContent.toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
}

jQuery.expr[":"].vicontains = function(a, i, m) {
    return a.value.toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
}


$("#meal-type").chosen();
$("#allergens").chosen();
$("[id^=meal-allergens-]").chosen();
$("#meal-id").chosen();


function filterTable(tableId, searchQuery) {
    if (!searchQuery) {
        $(`#${tableId} tbody tr`).show();
        return;
    }

    $(`#${tableId} tbody tr`).hide();
    $(`#${tableId} tbody tr:icontains("${searchQuery}")`).show();
    $(`#${tableId} tbody tr:has('input:vicontains("${searchQuery}")')`).show();
}