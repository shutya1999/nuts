//DELIVERY RADIO
let radioDelivery = document.querySelectorAll(".type-delivery__radio"),
    deliveryBlock = document.querySelector(".type-delivery__block_wrap");


if (deliveryBlock !== null){
    const form = document.querySelector(".mo-content");
    let np = `
        <div class="type-delivery__block novaposhta-wrap active" data-delivery="Нова Пошта">
            <div class="search-city">
                <input type="text" class="form-fields city-name" name="UserInfo[city]" data-ref="" placeholder="Введіть місто*" autocomplete="no">
                <ul class="delivery-list city-list hide"></ul>
            </div>
            <div class="search-department">
                <input type="text" class="form-fields department-input" name="UserInfo[department_np]" placeholder="Введіть номер відділення*" autocomplete="no">
                <ul class="delivery-list department-list hide"></ul>
            </div>
        </div>
    `;
    let ukr = `
        <div class="type-delivery__block ukrposhta-wrap" data-delivery="Укрпошта">
            <input type="text" class="form-fields" name="UserInfo[patronymic]" data-ref="" placeholder="Ім'я по батькові*" >
            <input type="text" class="form-fields" name="UserInfo[city]" data-ref="" placeholder="Введіть місто*" >
            <input type="text" class="form-fields" name="UserInfo[street]" placeholder="Введіть вулицю*" >
            <input type="number" class="form-fields" name="UserInfo[index_ukr]" placeholder="Поштовий індекс*" >
        </div>
    `;
    let courier = `
        <div class="type-delivery__block courier-wrap" data-delivery="Кур’єрська доставка">
            <input type="text" class="form-fields" name="UserInfo[city]" data-ref="" placeholder="Введіть місто*" >
            <input type="text" class="form-fields" name="UserInfo[street]" placeholder="Введіть вулицю*" >
            <input type="text" class="form-fields" name="UserInfo[house_number]" placeholder="Будинок*" >
            <input type="text" class="form-fields" name="UserInfo[apartment_number]" placeholder="Квартира*" >
        </div>
    `;

    radioDelivery.forEach(radio => {
        radio.addEventListener("input", function () {

            switch (radio.dataset.delivery){
                case "novaposhta":
                    deliveryBlock.innerHTML = np;
                    getDataNP();

                    break;
                case "ukrposhta":
                    deliveryBlock.innerHTML = ukr;
                    break;
                case "courier":
                    deliveryBlock.innerHTML = courier;
                    break;
                default:
                    deliveryBlock.innerHTML = "";
                    break;
            }
        })
    })


    // form.addEventListener("submit", function (e) {
    //
    //     let inputs = deliveryBlock.querySelectorAll('input');
    //     let inputLength = inputs.length;
    //     let valid = 0;
    //
    //     inputs.forEach(input => {
    //         if (input.value === ""){
    //             //console.log(input);
    //             input.classList.add("invalid");
    //         }else {
    //             valid ++;
    //         }
    //     })
    //
    //     if (valid === inputLength){
    //         form.submit();
    //     }
    // })

    function getDataNP() {
        let api_key = '616d22010ffec3f456c0f3924c062d1f';
        let url = "https://api.novaposhta.ua/v2.0/json/";
        let cityName = document.querySelector(".city-name");
        if (cityName !== null){
            let cityList = document.querySelector(".city-list"),
                departmentInput = document.querySelector(".department-input"),
                departmentList = document.querySelector(".department-list");

            cityName.addEventListener("input", function () {
                let body = `{
        "apiKey": "${api_key}",
        "modelName": "Address",
        "calledMethod": "searchSettlements",
            "methodProperties": {
                "CityName": "${cityName.value}",
                "Limit": 100
            }
        }`;
                let response = fetch(url, {
                    method: "POST",
                    headers: {
                        "content-type": "application/json",
                    },
                    body: body
                })
                    .then(response => response.json())
                    .then(function (json) {

                        let data = [];
                        json.data[0].Addresses.forEach(item => {
                            if (item.Warehouses > 0){
                                data.push(item)
                            }
                        });

                        if (json.success === false || json.data[0].TotalCount === 0){
                            createSubList_NP(data, "error");
                        } else {
                            createSubList_NP(data, "success");
                        }
                    });
            });

            function createSubList_NP(data, status){
                cityList.innerHTML = "";
                cityList.classList.remove("hide");

                if (status === "success"){
                    data.forEach(item => {
                        let listItem = document.createElement("li");
                        listItem.dataset.ref = item.Ref;
                        listItem.innerHTML = item.Present;
                        cityList.insertAdjacentElement("beforeend", listItem);
                    });

                    let listItem = document.querySelectorAll(".city-list li");
                    listItem.forEach(item => {
                        item.addEventListener("click", function () {
                            cityName.value = item.textContent;
                            departmentInput.dataset.ref = item.dataset.ref;//Ref для поля ввода с отделением
                            cityList.classList.add("hide");
                        })
                    })
                } else if (status === "error"){
                    let listItem = document.createElement("li");
                    listItem.innerHTML = "Такого міста не знайдено";
                    cityList.insertAdjacentElement("beforeend", listItem);
                }
            }

            departmentInput.addEventListener("input", function () {
                let ref = departmentInput.dataset.ref,
                    val = departmentInput.value;

                let body = `{
        "modelName": "AddressGeneral",
        "calledMethod": "getWarehouses",
        "methodProperties": {
             "SettlementRef": "${ref}"
        },
        "apiKey": "${api_key}"
    }`;
                let response = fetch(url, {
                    method: "POST",
                    headers: {
                        "content-type": "application/json",
                    },
                    body: body
                })
                    .then(response => response.json())
                    .then(function (json) {
                        // console.log(json);
                        departmentList.innerHTML = "";
                        departmentList.classList.remove("hide");

                        json.data.forEach(item => {
                            if (item.Number.indexOf(val) == 0){
                                let listItem = document.createElement("li");
                                listItem.innerHTML = item.Description;
                                departmentList.insertAdjacentElement("beforeend", listItem);
                            }
                        });

                        let listItem = document.querySelectorAll(".department-list li");
                        listItem.forEach(item => {
                            item.addEventListener("click", function () {
                                departmentInput.value = item.textContent;
                                departmentList.classList.add("hide");
                            })
                        })
                    });
            });
        }
    }

    getDataNP();
}



// VALID PASS
// let formAcc = document.querySelector("#form-acc");
//
// if (formAcc !== null){
//     let currentPass = document.querySelector("#userinfo-currentpassword");
//     let newPass = document.querySelector("#userinfo-newpassword");
//     let repeatPass = document.querySelector("#repeatPass");
//     let checkBox = document.querySelector("#userinfo-changepass");
//
//     checkBox.oninput = function () {
//         console.log(checkBox.checked);
//         if (checkBox.checked){
//             repeatPass.type = 'password';
//             newPass.type = 'password';
//         }else {
//             repeatPass.type = 'hidden';
//             newPass.type = 'hidden';
//         }
//     }
//
//     function validPass() {
//         if (checkBox.checked){
//             if (newPass.value === repeatPass.value && currentPass.value !== '') {
//                 if (newPass.closest('.has-error')){
//                     newPass.closest(".form-group").classList.remove("has-error");
//                 }
//                 if (repeatPass.closest('.has-error')){
//                     repeatPass.closest(".form-group").classList.remove("has-error");
//                 }
//                 if (currentPass.closest('.has-error')){
//                     currentPass.closest(".form-group").classList.remove("has-error");
//                 }
//
//                 newPass.closest(".form-group").classList.add("has-success");
//                 repeatPass.closest(".form-group").classList.add("has-success");
//                 repeatPass.closest(".form-group").querySelector(".help-block").innerHTML = '';
//
//                 currentPass.closest(".form-group").classList.add("has-success");
//                 currentPass.closest(".form-group").querySelector(".help-block").innerHTML = '';
//
//                 formAcc.submit();
//             }else {
//                 currentPass.closest(".form-group").classList.add("has-error");
//                 currentPass.closest(".form-group").querySelector(".help-block").innerHTML = 'Введіть пароль';
//
//                 newPass.closest(".form-group").classList.add("has-error");
//                 repeatPass.closest(".form-group").classList.add("has-error");
//                 repeatPass.closest(".form-group").querySelector(".help-block").innerHTML = 'Паролі не співпадають'
//             }
//             console.log("Check");
//             // return false;
//         }else {
//             console.log("No check");
//             formAcc.submit();
//         }
//     }

    // formAcc.onsubmit = function () {
    //     let newPass = document.querySelector("#userinfo-newpassword");
    //     let repeatPass = document.querySelector("#repeatPass");
    //     let checkBox = document.querySelector("#userinfo-changepass");
    //
    //     console.log(checkBox);
    //     // if (checkBox.checked()){
    //     //     console.log("Yess");
    //     // } else {
    //     //     console.log("Noo");
    //     // }
    //
    // };
// }