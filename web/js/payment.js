let check = true;
const merchantAccount = 'test_merch_n1';
const key = 'flk3409refn54t54t*FNJRET';
const form = document.querySelector("#w0");

let btn = document.querySelector("#btn-buy");
let jopa;
// console.log(Date.now());





function paymentType(tg) {
    let payment = tg.dataset.paymentType;


    if (payment === 'cart'){
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            console.log(document.querySelector(".has-error"));

            if (document.querySelector(".has-error") !== null){
                form.setAttribute("onsubmit", "return false;");
                e.preventDefault();
                console.log("WayForPay");
            }else {
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
                                if (response.reasonCode === 1100){

                                    // document.querySelector("#btn-buy").submit();
                                    console.log('submit');
                                    document.querySelector("#w0").submit();
                                }
                            },
                            function (response) {
                                console.log(response.reasonCode);

                                if (response.reasonCode === 1100){
                                    // form.submit();
                                    console.log('submit');
                                    document.querySelector("#w0").submit();
                                }
                            },
                            function (response) {
                                console.log(response);
                                if (response.reasonCode === 1100){
                                    // form.submit();
                                    // document.querySelector("#btn-buy").submit();
                                    console.log('submit');
                                    document.querySelector("#w0").submit();
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
            }
        })
    }
}