let filterCat = document.querySelectorAll(".filter-category input");

if (filterCat.length !== 0){
    let hiddenForm = document.querySelector(".hidden-form"),
        sorting = document.querySelectorAll('.sorting-select input'),
        sortingHidden = document.querySelector("#sortform-sort"),
        lowerPrice = document.querySelector(".form-fields__price._lower"),
        lowerPriceHidden = document.querySelector("#sortform-lower_price"),
        topPrice = document.querySelector(".form-fields__price._top"),
        topPriceHidden = document.querySelector("#sortform-top_price");

    lowerPrice.addEventListener("input", function () {
        //console.log(lowerPrice.value);
        lowerPriceHidden.value = lowerPrice.value;
    });
    topPrice.addEventListener("input", function () {
        topPriceHidden.value = topPrice.value;
    });

    sorting.forEach(item => {
        item.addEventListener("input", function () {
            sortingHidden.value = item.value;
        })
    });


    filterCat.forEach(filter => {
        filter.addEventListener("click", function () {
            getActiveFilterCat();
        });
    });
    function getActiveFilterCat() {
        let activeCat = [];
        filterCat.forEach(filter => {
            if (filter.checked){
                activeCat.push(filter);
            }
        })
        addFilterCat(activeCat);
    }
    function addFilterCat(activeCat) {
        let inputCat = hiddenForm.querySelectorAll("#sortform-category input");

        inputCat.forEach(hiddenInput => {
            hiddenInput.removeAttribute("checked");
        });
        inputCat.forEach(hiddenInput => {
            activeCat.forEach(activeFilter => {
                if (activeFilter.name === hiddenInput.value){
                    hiddenInput.setAttribute("checked", true);
                }
            })
        })
    }

    function reloadCatalog(data) {
        // console.log(data.keys());
        let catalogBlock = document.querySelector('.catalog-goods');
        catalogBlock.innerHTML = "";
        data.forEach(item => {
            let options = JSON.parse(item.option);

            let product = document.createElement("div");
            product.className = 'product-cart';
            let productPhoto = `
                <a href="/product/${item.url}" class="product-cart__photo">
                    <img src="/img/product/${item.img}" alt="${item.title}">
                </a>`;

            let title = `<h3 class="product-cart__name">
                <a href="/product/${item.url}">${item.title}</a>
            </h3>`;

            let info = document.createElement("div");
            info.className = 'product-cart__info dg form-price';

            let rating = `
                <div class="product-cart__rating">
                    <span class="star-fill" style="width: calc((${item.rating} * 100 / 5) * 1%)"></span>
                </div>`;

            let price;
            if (item.old_price !== 0){
                price = `
                <div class="product-cart__price">
                    <p>${item.price}₴<span class="old-price">${item.old_price}₴</span>
                    </p>
                </div>
            `;
            }else {
                price = `<div class="product-cart__price"><p>${item.price}₴</p></div>`;
            }
            let url = encodeURI("/cart/add?id=1&volume=200&qty=1");
            let buy = `
            <a href="${url}" onclick="addToCart(this)" data-id="${item.id}" class="btn btn-orange product-cart__buy add-to-cart">
                <p>Купити</p>
            </a>`;

            // let buy = document.createElement("a");
            // buy.className = "btn btn-orange product-cart__buy add-to-cart";
            // buy.href = `http://nuts-city-yii2/cart/add?id=1&volume%5Bquantity%5D=200&volume%5Bprice%5D=150&qty=1`;
            // buy.innerHTML = '<p>Купити</p>';
            // buy.setAttribute("onclick", "addToCart(this)");

            // btnBuy.href = `/cart/add?id=${data.id}&volume=${data.volume}&volume-type=${data.volumeType}&qty=${data.qty}`;


            // let buy = `
            // <a href="/cart/add?id=${item.id}&qty=1&volume=200" onclick="addToCart(this)" data-id="${item.id}" class="btn btn-orange product-cart__buy add-to-cart">
            //     <p>Купити</p>
            // </a>`;


            info.insertAdjacentHTML('beforeend', rating);
            info.insertAdjacentHTML('beforeend', price);
            info.insertAdjacentElement('beforeend', generateOption(options));
            info.insertAdjacentHTML('beforeend', buy);

            product.insertAdjacentHTML('beforeend', productPhoto);
            product.insertAdjacentHTML('beforeend', title);
            product.insertAdjacentElement('beforeend', info);


            catalogBlock.insertAdjacentElement('beforeend', product);

            function generateOption(optionData){

                let optionBlock = document.createElement("div");
                optionBlock.className = "product-cart__count";

                let select = document.createElement("div");
                select.className = "__select";
                select.setAttribute("data-state", '');

                let selectTitle = document.createElement("div");
                selectTitle.className = "__select__title";
                selectTitle.setAttribute("data-default", '');

                let selectContent = document.createElement("div");
                selectContent.className = "__select__content";

                selectTitle.innerHTML = `${Object.keys(optionData)[0]}: ${optionData[Object.keys(optionData)[0]][0].quantity}` ;

                for (let key in optionData) {
                    let i = 0;
                    optionData[key].forEach(val => {
                        let input;
                        if (i === 0){
                            input = `<input id="singleSelect_${item.id}" class="__select__input" type="radio" name="volume_${item.id}" value="${val.quantity}" checked>`
                        }else {
                            input = `<input id="singleSelect_${item.id}" class="__select__input" type="radio" name="volume_${item.id}" value="${val.quantity}">`
                        }
                        let label = `<label for="singleSelect_${item.id}" class="__select__label">${Object.keys(optionData)[0]}: ${val.quantity}</label>`;

                        selectContent.insertAdjacentHTML('beforeend', input);
                        selectContent.insertAdjacentHTML('beforeend', label);
                        i ++;
                    })
                }
                select.insertAdjacentElement('beforeend', selectTitle);
                select.insertAdjacentElement('beforeend', selectContent);

                optionBlock.insertAdjacentElement('beforeend', select);

                return optionBlock;
            }
        })

        pizda();
    }
}

const burger = document.querySelector(".burger");
burger.addEventListener("click", ()=>{
   burger.classList.toggle("active");
   document.body.classList.toggle("no-scroll");
});

const header = document.querySelector(".header"),
      headerAuxiliary = document.querySelector(".header-auxiliary");
window.addEventListener("scroll", function () {

    if (this.pageYOffset > 400){
        header.classList.add("fixed");
        headerAuxiliary.classList.add("active");
    }else {
        header.classList.add("test");
        setTimeout(function () {
            headerAuxiliary.classList.remove("active");
            header.classList.remove("test");
            header.classList.remove("fixed");
        },200);
    }
});


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


const slider = document.querySelector(".swiper-container");
if (slider !== null){
    const swiper = new Swiper('.banner-slider', {
        speed: 400,
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        autoplay: {
            delay: 5000,
        },
    });
    let swiperHit = undefined;

    window.addEventListener("resize", resize);
    function resize() {
        let width = document.documentElement.clientWidth;
        if(width > 1024 && swiperHit === undefined){
            swiperHit = new Swiper('.hit-products__content', {
                spaceBetween: 10,
                breakpoints: {
                    1024: {
                        slidesPerView: 3,
                        navigation: false
                    },
                    1200: {
                        slidesPerView: 4,
                        navigation: {
                            nextEl: '.hit-products__next',
                            prevEl: '.hit-products__prev',
                        },
                    }
                }
            });
        }else if (width <= 1024 && swiperHit !== undefined){
            swiperHit.destroy();
            swiperHit = undefined;
        }
    }
    resize();
}



let gallery_thumbs_slide = document.querySelectorAll(".gallery-thumbs_slide"),
    gallery_main_slider = document.querySelector(".gallery-main");
if (gallery_main_slider != null){
    // Слайдер карточки товара
    let galleryTop = new Swiper('.gallery-main', {
        navigation: {
            nextEl: '.next-slide',
            prevEl: '.prev-slide',
        },
        slidesPerView: 1,
        observer: true,
        observeParents: true,
        breakpoints: {
            320: {
                allowTouchMove: true,
            },
            1024: {
                allowTouchMove: false,
            }
        }
    });
    let galleryThumbs = new Swiper('.gallery-thumbs', {
        navigation: {
            nextEl: '.next-slide',
            prevEl: '.prev-slide',
        },
        spaceBetween: 10,
        slidesPerView: 4,
        allowTouchMove: false,
    });

    gallery_thumbs_slide.forEach(item => {
        item.style.height = `${+item.clientWidth / 1.5}px`;
        item.addEventListener("click", function () {
            galleryTop.update();
            darkenSlides();
            item.classList.add("highlight");
            galleryTop.slideTo(+galleryThumbs.clickedIndex, 400);
        })
    });
    function darkenSlides() {
        gallery_thumbs_slide.forEach(item => {
            item.classList.remove("highlight");
        })
    }
    function getActiveSlide_main(){
        darkenSlides();
        galleryThumbs.el.querySelectorAll(".swiper-slide")[galleryTop.activeIndex].classList.add("highlight")
    }
    gallery_main_slider.addEventListener("click", getActiveSlide_main);

// ИНДИКАЦИЯ ВЫБОРА "ОПИСАНИЕ / ОТЗЫВЫ" КАРТОЧКА ТОВАРА
    window.onload = function () {
        let goods_title = document.querySelectorAll(".additional-information__nav .title");
        if (goods_title != null) {
            let indicator = document.querySelector(".indication");

            goods_title.forEach(item => highlightGoodsTitle(item));
            goods_title.forEach(item => {
                item.addEventListener("click", function () {
                    item.classList.add("active");
                    highlightGoodsTitle(item);

                    clearAdditionalClass();
                    document.querySelector(`.${item.dataset.additional}`).classList.add("show");
                })
            });

            function highlightGoodsTitle(item) {
                if (item.closest(".active") !== null) {
                    let left = item.offsetLeft;
                    let width = item.getBoundingClientRect().width;
                    indicator.style.transform = `translateX(${left}px)`;
                    indicator.style.width = width + "px";
                }
            }
            function clearAdditionalClass() {
                let additional = document.querySelectorAll(".additional-js");
                additional.forEach(item => {
                    item.classList.remove("show");
                })
            }
        }
    };

}

// СЧЕТЧИК КОЛ-ВО ТОВАРА
// let goodsCounterInput = document.querySelector("#count");
//
// if (goodsCounterInput !== null){
//     goodsCounterInput.addEventListener("change", function () {
//         if (+goodsCounterInput.value > 99){
//             goodsCounterInput.value = 99;
//         }else if (+goodsCounterInput.value < 1){
//             goodsCounterInput.value = 1;
//         }
//     });
//     if (goodsCounterInput !== null){
//         function increaseNumber() {
//             goodsCounterInput.value = +goodsCounterInput.value + 1;
//             if (+goodsCounterInput.value > 99){
//                 goodsCounterInput.value = 99;
//             }
//             // changeLinkBuy('qty', goodsCounterInput.value, goodsCounterInput);
//         }
//         function reduceNumber() {
//             goodsCounterInput.value = +goodsCounterInput.value - 1;
//             if (+goodsCounterInput.value < 1){
//                 goodsCounterInput.value = 1;
//             }
//             // changeLinkBuy('qty', goodsCounterInput.value, goodsCounterInput);
//         }
//     }
// }

let goodsCounterInput = document.querySelectorAll(".count");

if (goodsCounterInput.length > 0){
    goodsCounterInput.forEach(counter => {
        counter.addEventListener("change", function () {
            if (+counter.value > 99){
                counter.value = 99;
            }else if (+counter.value < 1){
                counter.value = 1;
            }
        });
    });

    function increaseNumber(input) {
        input.value = +input.value + 1;
        if (+input.value > 99){
            input.value = 99;
        }
        // changeLinkBuy('qty', goodsCounterInput.value, goodsCounterInput);
    }
    function reduceNumber(input) {
        input.value = +input.value - 1;
        if (+input.value < 1){
            input.value = 1;
        }
        // changeLinkBuy('qty', goodsCounterInput.value, goodsCounterInput);
    }

}


// SEARCH
const searchIcon = document.querySelector(".search-icon"),
      search_block = document.querySelector('.search-block_wrap'),
      nav = document.querySelector(".nav"),
      header_contacts = document.querySelector(".header-contacts");
searchIcon.addEventListener("click", function () {
    nav.classList.toggle("hide");
    header_contacts.classList.toggle("hide");
    search_block.classList.toggle("show");
});

// SELECT OPTION
function pizda() {
    const selectSingle_title = document.querySelectorAll('.__select__title');
    if (selectSingle_title !== null){
        selectSingle_title.forEach(item => {
            item.addEventListener("click", function () {
                // console.log("Click");
                let selectSingle = item.closest(".__select"),
                    selectSingle_labels = selectSingle.querySelectorAll('.__select__label');

                chooseSelect(selectSingle_labels, item, selectSingle);

                if ('active' === selectSingle.getAttribute('data-state')){
                    selectSingle.setAttribute('data-state', '');
                }else {
                    selectSingle.setAttribute('data-state', 'active');
                }

            })
        });

// Close when click to option
        function chooseSelect(selectSingle_labels, selectSingle_title, selectSingle){
            selectSingle_labels.forEach(item => {
                item.addEventListener("click", function (evt) {
                    selectSingle_title.textContent = evt.target.textContent;
                    selectSingle.setAttribute('data-state', '');
                })
            });
        }
    }
}
pizda();


//DELIVERY RADIO
let radioDelivery = document.querySelectorAll(".type-delivery__radio"),
    deliveryBlock = document.querySelectorAll(".type-delivery__block");

if (radioDelivery !== null){
    radioDelivery.forEach(radio => {
        radio.addEventListener("input", function () {
            deliveryBlock.forEach(block => {
                block.classList.remove("active");
                if (radio.value === block.dataset.delivery){
                    block.classList.add("active");
                }
            })
        })
    })
}

let filterTabs = document.querySelectorAll(".filter-mob-tab");
filterTabs.forEach(tab => {
    tab.addEventListener("click", function () {
        if (tab.closest("._main")){
            const mainTab = document.querySelector(".filter-mob-content");
            //console.log(mainTab.clientHeight);
            mainTab.classList.toggle("active");
        }
        tab.classList.toggle("active");
    });
})

// SHOW MORE REVIEW
let showReviewBtn = document.querySelector(".more-reviews");
if (showReviewBtn != null){
    let reviews = document.querySelectorAll(".additional-user-review");
    showReviewBtn.addEventListener("click", function () {
        for (let i = 5; i < reviews.length; i++){
            reviews[i].classList.remove("hidden");
            this.classList.add('hidden');
        }
    })
}
// SHOW MORE REVIEW


// CART

//CART HEADER
const cartHeader = document.querySelector(".header-cart");

cartHeader.addEventListener("click", showCart);
function showCart(e) {
    let cartContent = document.querySelector(".header-cart__content");
    // console.log(e.target);
    if (e.target == this || e.target.closest(".header-cart__close")){
        cartContent.classList.toggle("active");
    }
}

// ОБНОВЛЕНИЕ КОРЗИНЫ ПРИ ЗАГРУЗКЕ СТРАНИЦИ
function getCart(){
    $.ajax({
        url: "/cart/show",
        type: 'GET',
        success: function (res) {
            // console.log(res);
            modalCart(res);
        },
        error: function () {
            console.log("Error");
        }
    })
}
getCart();


// добавление товара в корзину
// function testFunc(tg, event) {
//     event.preventDefault();
//     console.log(tg);
// }
let btnBuy = document.querySelectorAll(".add-to-cart");
function addToCart(btn){
    event.preventDefault();
    // e.preventDefault();
    let id = btn.dataset.id;
    let qty = 1;
    let volume;

    if (document.querySelector('#count') != null){
        qty = +document.querySelector('#count').value;
    }

    let volumeInput = btn.closest(".form-price").querySelectorAll(".__select__input");
    // console.log(btn.closest(".form-price"));

    // console.log(this.closest(".form-price").querySelectorAll(".__select__input"));

    volumeInput.forEach(input => {
        if (input.checked){
            volume = input.value;
        }
    })

    $.ajax({
        url: "/cart/add",
        data: {
            id: id,
            volume: volume,
            qty: qty
        },
        type: "GET",
        success: function (res) {
            // console.log(res);
            modalCart(res);
        },
        error: function () {
            console.log("Error");
        }
    })
}

function modalCart(res) {
    let cartContent = document.querySelector(".header-cart");

    // console.log(cartContent.querySelector(".active"));

    if (cartContent.querySelector(".active")){
        cartContent.innerHTML = res;
        cartContent.querySelector(".header-cart__content").classList.add("active");
    }else {
        cartContent.innerHTML = res;
    }


    if (cartContent.querySelectorAll('.header-cart__item').length > 4){
        cartContent.classList.add('_scroll');
    }else {
        cartContent.classList.remove('_scroll');
    }
}

// CART

// PRICE PRODUCT
function priceProduct(data, form) {
    let price = form.querySelector('.goods-price');
    let btnBuy = form.querySelector(".add-to-cart");

    price.innerHTML = `${data.price} ₴`;
    btnBuy.href = `/cart/add?id=${data.id}&volume=${data.volume}&volume-type=${data.volumeType}&qty=${data.qty}`;
}

let selectProductVolumeBtn = document.querySelectorAll(".__select__label");
selectProductVolumeBtn.forEach(item => {
    item.addEventListener("click", ajaxPriceProduct);
})

// ОБНОВЛЕНИЕ ЦЕНЫ ТОВАРА ПРИ КЛИКЕ
function ajaxPriceProduct(tg) {
    let parent;
    let volume;
    if (tg.target){
        parent = tg.target.closest('.form-price');
        volume = tg.target.previousElementSibling.value;
    } else {
        parent = tg.closest('.form-price');

        parent.querySelectorAll(".__select__input").forEach(item => {
            if (item.checked){
                volume = item.value;
            }
        })
    }

    let qty = 1;
    let id = parent.dataset.id;

    if (parent.querySelector(".count") !== null){
        qty = +parent.querySelector(".count").value;
    }

    $.ajax({
        url: '/price/get-price',
        type: 'GET',
        data: {
            id: id,
            qty: qty,
            volume: volume
        },
        success: function(res){
            // console.log(res);
            priceProduct(res, parent);
        },
        error: function(){
            alert('Error!');
        }
    });
}

// УДАЛЕНИЕ ТОВАРА С КОРЗИНЫ
function delProdInCart(id, volume) {
    $.ajax({
        url: "/cart/del-item",
        data: {
            id: id,
            volume: volume
        },
        type: "GET",
        success: function (res) {
            if (document.location.pathname === "/cart/checkout"){
                location = '/cart/checkout';
            }
            modalCart(res);
        },
        error: function () {
            console.log("Error");
        }
    })
}

function changeCart(input, id, volume) {
    $.ajax({
        url: "/cart/change-cart",
        data: {
            id: id,
            volume: volume,
            qty: input.value
        },
        type: "GET",
        success: function (res) {
            location = '/cart/checkout';
        },
        error: function () {
            console.log("Error");
        }
    })
}
