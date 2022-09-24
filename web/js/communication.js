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
        location.reload(true);
    }
}

function login() {
    const data = {
        email: document.querySelector("#login-form #email").value,
        password: document.querySelector("#login-form #password").value,
        goto: document.querySelector("#login-form #goto").value
    };

    sendAndRespond("api/login.php", data);
}

function logout() {
    sendAndRespond("api/logout.php", null);
}

async function showPeople() {
    const response = await fetch("admin/people.php");
    document.querySelector("#admin-settings").innerHTML = await response.text();
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

    sendAndRespond("api/admin/add-person.php", data);
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

    sendAndRespond("api/admin/update-person.php", data);
}

function deletePerson(id) {
    const data = {
        id: id
    };

    sendAndRespond("api/admin/delete-person.php", data);
}

async function showMeals() {
    const response = await fetch("admin/meals.php");
    document.querySelector("#admin-settings").innerHTML = await response.text();
}

function addMeal() {
    const data = {
        name: document.querySelector("#add-meal-form #name").value,
        price: document.querySelector("#add-meal-form #price").value,
        amount: document.querySelector("#add-meal-form #amount").value,
        mealType: document.querySelector("#add-meal-form #meal-type").value
    };

    sendAndRespond("api/admin/add-meal.php", data);
}

function updateMeal(id) {
    const data = {
        id: id,
        name: document.querySelector(`#meal-name-${id}`).value,
        price: document.querySelector(`#meal-price-${id}`).value,
        amount: document.querySelector(`#meal-amount-${id}`).value
    };

    sendAndRespond("api/admin/update-meal.php", data);
}

function deleteMeal(id) {
    const data = {
        id: id
    };

    sendAndRespond("api/admin/delete-meal.php", data);
}