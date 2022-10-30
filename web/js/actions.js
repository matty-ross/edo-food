jQuery.expr[":"].icontains = function(a, i, m) {
    return jQuery(a).text().toLowerCase().indexOf(m[3].toLowerCase()) >= 0;
}


$("#meal-type").chosen();
$("#allergens").chosen();
$("[id^=meal-allergens-]").chosen();


function filterTable(tableId, searchQuery) {
    if (!searchQuery) {
        $(`#${tableId} tbody tr`).show();
        return;
    }

    $(`#${tableId} tbody tr`).hide();
    $(`#${tableId} tbody tr:contains("${searchQuery}")`).show();
    $(`#${tableId} tbody tr:has("input[value*='${searchQuery}']")`).show();
    //$(`#${tableId} tbody tr:has("input[value*='${searchQuery}' i]")`).show();
}