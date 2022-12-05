async function sendAndRespond(url, data) {
    let response = null;
    if (data !== null) {
        response = await fetch(url, {
            method: "POST",
            body: JSON.stringify(data)
        });
    } else {
        response = await fetch(url);
    }

    const json = await response.json();
    if (json.message) {
        alert(json.message);
    }
    if (json.goto) {
        location = json.goto;
    }
    if (json.refresh) {
        location.reload();
    }
}

function loginEmailPassword() {
    const data = {
        email: document.querySelector("#login-form #email").value,
        password: document.querySelector("#login-form #password").value,
        goto: document.querySelector("#login-form #goto").value
    };

    sendAndRespond("./api/login_email_password.php", data);
}

function loginId(id) {
    const data = {
        id: id,
        goto: document.querySelector("#login-form #goto").value
    };

    sendAndRespond("./api/login_id.php", data);
}

function logout() {
    sendAndRespond("./api/logout.php", null);
}

function addPerson() {
    const data = {
        id: document.querySelector("#add-person-form #id").value,
        fullName: document.querySelector("#add-person-form #full-name").value,
        email: document.querySelector("#add-person-form #email").value,
        password: document.querySelector("#add-person-form #password").value,
        credit: document.querySelector("#add-person-form #credit").value,
        admin: document.querySelector("#add-person-form #admin").checked
    };

    sendAndRespond("./api/admin/add-person.php", data);
}

function updatePerson(id) {
    const data = {
        id: id,
        newId: document.querySelector(`#person-id-${id}`).value,
        fullName: document.querySelector(`#person-full-name-${id}`).value,
        email: document.querySelector(`#person-email-${id}`).value,
        password: document.querySelector(`#person-change-password-${id}`).value,
        addCredit: document.querySelector(`#person-add-credit-${id}`).value,
        admin: document.querySelector(`#person-admin-${id}`).checked,
    };

    sendAndRespond("./api/admin/update-person.php", data);
}

function deletePerson(id) {
    const data = {
        id: id
    };

    sendAndRespond("./api/admin/delete-person.php", data);
}

function addMeal() {
    const getAllergens = () => {
        let allergens = [];
        for (const allergen of document.querySelector("#add-meal-form #allergens").selectedOptions) {
            allergens.push(allergen.value);
        }
        return allergens;
    };
    
    const data = {
        name: document.querySelector("#add-meal-form #name").value,
        price: document.querySelector("#add-meal-form #price").value,
        amount: document.querySelector("#add-meal-form #amount").value,
        mealType: document.querySelector("#add-meal-form #meal-type").value,
        allergens: getAllergens()
    };

    sendAndRespond("./api/admin/add-meal.php", data);
}

function updateMeal(id) {
    const getAllergens = () => {
        let allergens = [];
        for (const allergen of document.querySelector(`#meal-allergens-${id}`).selectedOptions) {
            allergens.push(allergen.value);
        }
        return allergens;
    };

    const data = {
        id: id,
        name: document.querySelector(`#meal-name-${id}`).value,
        price: document.querySelector(`#meal-price-${id}`).value,
        amount: document.querySelector(`#meal-amount-${id}`).value,
        allergens: getAllergens()
    };

    sendAndRespond("./api/admin/update-meal.php", data);
}

function deleteMeal(id) {
    const data = {
        id: id
    };

    sendAndRespond("./api/admin/delete-meal.php", data);
}

function addAllergen() {
    const data = {
        name: document.querySelector("#add-allergen-form #allergen-name").value
    };

    sendAndRespond("./api/admin/add-allergen.php", data);
}

function updateAllergen(id) {
    const data = {
        id: id,
        name: document.querySelector(`#allergen-name-${id}`).value
    };

    sendAndRespond("./api/admin/update-allergen.php", data);
}

function deleteAllergen(id) {
    const data = {
        id: id
    };

    sendAndRespond("./api/admin/delete-allergen.php", data);
}

function addMenuItem() {
    const data = {
        mealId: document.querySelector("#meal-id").value,
        date: document.querySelector("#date").value
    };

    sendAndRespond("./api/admin/add-menu-item.php", data);
}

function deleteMenuItem(id) {
    const data = {
        id: id
    };

    sendAndRespond("./api/admin/delete-menu-item.php", data);
}

function addOrder(menuItemId) {
    if (confirm("Naozaj si chcete objednať toto jedlo?")) {
        const data = {
            menuItemId: menuItemId
        };
    
        sendAndRespond("./api/menu/add-order.php", data);
    }
}

function deleteOrder(id) {
    const data = {
        id: id
    };

    sendAndRespond("./api/menu/delete-order.php", data);
}