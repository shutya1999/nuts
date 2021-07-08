AOS.init();

let filterCat = document.querySelectorAll(".filter-category input");

if (filterCat.length !== 0){
    // получение выбраных фильтров
    let hiddenForm = document.querySelector(".hidden-form"),
        sorting = document.querySelectorAll('.sorting-select input'),
        sortingHidden = document.querySelector("#sortform-sort"),
        lowerPrice = document.querySelector(".form-fields__price._lower"),
        lowerPriceHidden = document.querySelector("#sortform-lower_price"),
        topPrice = document.querySelector(".form-fields__price._top"),
        topPriceHidden = document.querySelector("#sortform-top_price");

    lowerPrice.addEventListener("change", function () {
        //console.log(lowerPrice.value);
        lowerPriceHidden.value = lowerPrice.value;
        filtered();
    });
    topPrice.addEventListener("change", function () {
        topPriceHidden.value = topPrice.value;
        filtered();
    });

    sorting.forEach(item => {
        item.addEventListener("input", function () {
            sortingHidden.value = item.value;
            filtered();
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
        filtered();
    }

    function filtered() {
        let form = $('#form-filter');
        // form.on('beforeSubmit', function(){
            let data = form.serialize();
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: data,
                success: function(res){
                    createPagin(res);
                },
                error: function(){
                    alert('Error!');
                }
            });
            return false;
        // });
    }

    // получение выбраных фильтров (конец)


    function reloadCatalog(data) {
        let delayCounter = 0;
        // console.log(data.keys());
        let catalogBlock = document.querySelector('.catalog-goods');
        catalogBlock.innerHTML = "";
        data.forEach(item => {
            let options = JSON.parse(item.option);

            let product = document.createElement("div");
            product.className = 'product-cart';
            product.dataset.aos = "fade-up";
            product.dataset.aosDuration = "500";
            product.dataset.aosDelay = 100 + delayCounter;



            let productPhoto = `
                <a href="/product/${item.url}" class="product-cart__photo">
                    <img src="/img/product/${item.img}" alt="${item.title}">
                </a>`;

            let title = `<h3 class="product-cart__name">
                <a href="/product/${item.url}">${item.title}</a>
            </h3>`;

            let info = document.createElement("div");
            info.className = 'product-cart__info dg form-price';
            info.dataset.id = item.id;

            let rating = `
                <div class="product-cart__rating">
                    <span class="star-fill" style="width: calc((${item.rating} * 100 / 5) * 1%)"></span>
                </div>`;

            let price;
            if (item.old_price !== 0){
                price = `
                <div class="product-cart__price">
                    <p class="goods-price">${item.price}₴
                        <span class="old-price">${item.old_price}₴</span>
                    </p>
                </div>
            `;
            }else {
                price = `<div class="product-cart__price"><p class="goods-price">${item.price}₴</p></div>`;
            }
            let url = encodeURI("/cart/add?id=1&volume=200&qty=1");
            let buy = `
            <a href="${url}" onclick="addToCart(this)" data-id="${item.id}" class="btn btn-orange product-cart__buy add-to-cart">
                <p>Купити</p>
            </a>`;

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
                selectTitle.setAttribute("onclick", "showSelect(this)");

                let selectContent = document.createElement("div");
                selectContent.className = "__select__content";

                selectTitle.innerHTML = `${Object.keys(optionData)[0]}: ${optionData[Object.keys(optionData)[0]][0].quantity}` ;

                for (let key in optionData) {
                    let i = 0;
                    optionData[key].forEach(val => {
                        let input;
                        if (i === 0){
                            input = `<input id="singleSelect${i}_${item.id}" class="__select__input" type="radio" name="volume_${item.id}" value="${val.quantity}" checked>`
                        }else {
                            input = `<input id="singleSelect${i}_${item.id}" class="__select__input" type="radio" name="volume_${item.id}" value="${val.quantity}">`
                        }
                        let label = `<label for="singleSelect${i}_${item.id}" class="__select__label">${Object.keys(optionData)[0]}: ${val.quantity}</label>`;

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
            delayCounter += 100;
        });
    }
    createPagin(products);//создаем пагинацию при первой загрузке страници
}

function createPagin(data) {
    // let paginBtns = document.querySelectorAll(".pagin-page");
    const paginBlock = document.querySelector(".pagination"),
          paginBlockContent = paginBlock.querySelector('.pagin-page__wrap'),
          paginNext = document.querySelector(".pagin-next span"),
          paginPrev = document.querySelector(".pagin-prev span");

    const notesOnPage = 3;

    let totalPage = Math.ceil(data.length  / notesOnPage);

    if (data.length <= notesOnPage){
        paginBlock.style.display = "none";
        reloadCatalog(data);
    }else {
        paginBlock.style.display = "flex";

        paginBlockContent.innerHTML = "";
        let paginBtns = [];
        for (let i = 0; i < totalPage; i++){
            let paginElem = document.createElement("li");
            paginElem.className = "pagin-page";
            paginElem.dataset.page = i + 1;
            paginElem.innerHTML = `<span>${i + 1}</span>`;

            paginBtns.push(paginElem);
            paginBlockContent.insertAdjacentElement("beforeend", paginElem);
        }
        showPage(paginBtns[0]);


        paginBtns.forEach(paginBtn => {
            // console.log(paginBtn);
            paginBtn.addEventListener("click", function () {
                showPage(paginBtn);
            })
        });


        function showPage(paginBtn) {

            let currentPaginItem = document.querySelector(".pagin-page__wrap .active");
            if (currentPaginItem) {
                currentPaginItem.classList.remove("active");
            }
            paginBtn.classList.add("active");

            if (paginBtns[0].closest('.active')){
                paginPrev.parentElement.classList.add("disabled");
            }else {
                paginPrev.parentElement.classList.remove("disabled");
            }


            if (paginBtns[paginBtns.length - 1].closest('.active')){
                paginNext.parentElement.classList.add("disabled");
            }else {
                paginNext.parentElement.classList.remove("disabled");
            }

            let pageNum = +paginBtn.dataset.page;
            let start = (pageNum - 1) * notesOnPage;
            let end = start + notesOnPage;

            let notes = data.slice(start, end);

            reloadCatalog(notes);
        }

        paginNext.onclick = function () {
            let item = this.closest(".pagination").querySelector(".pagin-page__wrap .active");
            if (item.nextElementSibling){
                showPage(item.nextElementSibling);
            }
        }

        paginPrev.onclick = function () {
            let item = this.closest(".pagination").querySelector(".pagin-page__wrap .active");
            if (item.previousElementSibling){
                showPage(item.previousElementSibling);
            }
        }
    }

}

const burger = document.querySelector(".burger"),
    hiddenMenu = document.querySelector(".hidden-menu");

burger.addEventListener("click", ()=>{
    burger.classList.toggle("active");
    hiddenMenu.classList.toggle("active");
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

    swiperHit = new Swiper('.hit-products__content', {
        spaceBetween: 10,
        breakpoints: {
            320: {
                slidesPerView: 1.5,
                navigation: false
            },
            768: {
                slidesPerView: 2.5,
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
    let maxHeightSlideHit = [];
    swiperHit.slides.forEach(slide => {
        maxHeightSlideHit.push(slide.clientHeight);
    });
    swiperHit.slides.forEach(slide => {
        slide.style.height = Math.max(...maxHeightSlideHit) + "px";
    });
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
    search_block = document.querySelector('.search-block_wrap');

searchIcon.addEventListener("click", function () {
    this.classList.toggle("active");
    header.classList.toggle("show-res");

    searchRes.classList.remove('show-res');
    search_block.classList.remove('show-res');
    document.body.classList.toggle("blur");
    document.body.classList.toggle("no-scroll");

});

const searchInput = document.querySelector(".search-fields"),
      searchRes = document.querySelector(".search-res");

searchInput.addEventListener("input", search);
searchInput.addEventListener("focus", function () {
    searchRes.classList.add('show-res');
    search_block.classList.add('show-res');
});

function search() {
    let value = this.value;
    let url = `/search/view?val=${value}`;

    if (value !== ""){
        let response = fetch(url)
            .then(response => response.text())
            .then(function (data) {
                searchRes.innerHTML = data;
                let count = searchRes.querySelector(".count-res").dataset.count;
                // console.log(+count);
                if (+count > 3){
                    searchRes.classList.add("height-res");
                }else {
                    searchRes.classList.remove("height-res");
                }
            });
    } else {
        console.log("Pusto");
        searchRes.innerHTML = "<p style='text-align: center;'>Введіть щось</p>"
        searchRes.classList.remove("height-res");
    }

}



// SELECT OPTION
function showSelect(selectTitle) {
    // console.log(selectTitle);
    let selectSingle = selectTitle.closest(".__select"),
        selectSingle_labels = selectSingle.querySelectorAll('.__select__label');

    chooseSelect(selectSingle_labels, selectTitle, selectSingle);

    if ('active' === selectSingle.getAttribute('data-state')){
        selectSingle.setAttribute('data-state', '');
    }else {
        selectSingle.setAttribute('data-state', 'active');
    }

// Close when click to option
    function chooseSelect(selectSingle_labels, item, selectSingle){
        selectSingle_labels.forEach(item => {
            item.addEventListener("click", function (evt) {
                selectTitle.textContent = evt.target.textContent;
                selectSingle.setAttribute('data-state', '');
            })
        });
    }
}



//DELIVERY RADIO
let radioDelivery = document.querySelectorAll(".type-delivery__radio"),
    deliveryBlock = document.querySelector(".type-delivery__block_wrap");

if (deliveryBlock !== null){
    const form = document.querySelector(".mo-content");
    let np = `
        <div class="type-delivery__block novaposhta-wrap active" data-delivery="Нова Пошта">
            <div class="search-city">
                <input type="text" class="form-fields city-name" name="Order[city]" data-ref="" placeholder="Введіть місто*" autocomplete="no">
                <ul class="delivery-list city-list hide"></ul>
            </div>
            <div class="search-department">
                <input type="text" class="form-fields department-input" name="Order[department_np]" placeholder="Введіть номер відділення*" autocomplete="no">
                <ul class="delivery-list department-list hide"></ul>
            </div>
        </div>
    `;
    let ukr = `
        <div class="type-delivery__block ukrposhta-wrap" data-delivery="Укрпошта">
            <input type="text" class="form-fields" name="Order[city]" data-ref="" placeholder="Введіть місто*" >
            <input type="text" class="form-fields" name="Order[street]" placeholder="Введіть вулицю*" >
            <input type="number" class="form-fields" name="Order[index_ukr]" placeholder="Поштовий індекс*" >
        </div>
    `;
    let courier = `
        <div class="type-delivery__block courier-wrap" data-delivery="Кур’єрська доставка">
            <input type="text" class="form-fields" name="Order[city]" data-ref="" placeholder="Введіть місто*" >
            <input type="text" class="form-fields" name="Order[street]" placeholder="Введіть вулицю*" >
            <input type="text" class="form-fields" name="Order[house_number]" placeholder="Будинок*" >
            <input type="text" class="form-fields" name="Order[apartment_number]" placeholder="Квартира*" >
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


    form.addEventListener("submit", function (e) {

        let inputs = deliveryBlock.querySelectorAll('input');
        let inputLength = inputs.length;
        let valid = 0;

        inputs.forEach(input => {
            if (input.value === ""){
                console.log(input);
                input.classList.add("invalid");
            }else {
                valid ++;
            }
        })

        if (valid === inputLength){
            form.submit();
        }
    })

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

    // console.log(volumeInput);

    volumeInput.forEach(input => {
        // console.log(input);
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
    // console.log(parent);
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
