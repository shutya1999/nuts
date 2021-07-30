let check = true;
const merchantAccount = 'test_merch_n1';
const key = 'flk3409refn54t54t*FNJRET';
const form = document.querySelector("#w0");

let btn = document.querySelector("#btn-buy");
let jopa;
// console.log(Date.now());

function paymentType(tg) {
    let payment = tg.dataset.paymentType;
//
    if (payment === 'cart'){
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            let form = $("#w0");
            $.ajax({
                type : "post",
                url : '/cart/cart-data',
                data : form.serializeArray()

            }).done(function(data) {
                if (data.error == null) {
                    // Если ответ сервера успешно получен
                    //console.log(data);

                    let wayforpay = new Wayforpay();

                    wayforpay.run(JSON.parse(data),
                        function (response) {
                            console.log(response);
                            if (response.reasonCode === 1101){

                                document.querySelector("#btn-buy").submit();
                            }
                        },
                        function (response) {
                            console.log(response.reasonCode);

                            if (response.reasonCode === 1101){
                                // form.submit();
                                console.log('submit');
                                document.querySelector("#w0").submit();
                            }
                        },
                        function (response) {
                            console.log(response);
                            if (response.reasonCode === 1101){
                                // form.submit();
                                document.querySelector("#btn-buy").submit();
                            }
                        }
                    );

                } else {
                    // Если при обработке данных на сервере произошла ошибка
                    console.log("Error");
                }
            }).fail(function() {
                console.log("Error2");
            })
        })

//         check = false;
//         // btn.setAttribute("onclick", 'pay();');
//
//         let dataCart = fetch("/cart/cart-data")
//             .then(response => response.json())
//             .then(function (data) {
//                 console.log(form);
//                 jopa = data;
//                 form.setAttribute('onsubmit', "return false;");
//             });
//
    }
}


form.addEventListener("submit", function (e) {
    // e.preventDefault();
    // console.log("Forma");
    //form.setAttribute('onsubmit', "return false;");


    // console.log(document.querySelector('input[name="Order[payment_type]"]:checked'))

    // let wayforpay = new Wayforpay();
    //
    // wayforpay.run(JSON.parse(jopa['cart.wayforpay']),
    //     function (response) {
    //         console.log(response);
    //     },
    //     function (response) {
    //         console.log(response);
    //     },
    //     function (response) {
    //         console.log(response);
    //     }
    // );


    // e.preventDefault();
    // btn.addEventListener('click', function () {
    //     let wayforpay = new Wayforpay();
    //
    //     wayforpay.run(JSON.parse(data['cart.wayforpay']),
    //         function (response) {
    //             console.log(response);
    //         },
    //         function (response) {
    //             console.log(response);
    //         },
    //         function (response) {
    //             console.log(response);
    //         }
    //     );
    // })
})

// console.log(dataCart);