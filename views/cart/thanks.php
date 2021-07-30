<?php $this->registerCssFile('@web/css/index/index.css'); ?>
<?php  ?>

<div class="container indent">
    <h1>Оплата</h1>


    <script id="widget-wfp-script" language="javascript" type="text/javascript" src="https://secure.wayforpay.com/server/pay-widget.js"></script>
    <?php
    $string = "test_merch_n1;https://nuts-city.yh-web.space;1488133722827051999;1415379863;10;UAH;Test;10;1";
    $key = 'flk3409refn54t54t*FNJRET';
    $hash = hash_hmac("md5",$string,$key);
    ?>

    <?= $hash; ?>

    <script type="text/javascript">
        var wayforpay = new Wayforpay();
        var pay = function () {
            wayforpay.run({
                    merchantAccount : "test_merch_n1",
                    merchantDomainName : "https://nuts-city.yh-web.space",
                    authorizationType : "SimpleSignature",
                    merchantSignature : '834235984facdf5630101160a9d99841',
                    orderReference : "1488133722827051999",
                    orderDate : "1415379863",
                    amount : "10",
                    currency : "UAH",
                    productName : "Test",
                    productPrice : "1",
                    productCount : "10",
                    clientFirstName : "Вася",
                    clientLastName : "Васечкин",
                    clientEmail : "some@mail.com",
                    clientPhone: "380631234567",
                    language: "UA"
                },
                function (response) {
                console.log(response);
// on approved
                },
                function (response) {
                    console.log(response);
// on declined
                },
                function (response) {
                    console.log(response);
// on pending or in processing
                }
            );
        }
    </script>

    <button type="button" onclick="pay();">Оплатить</button>
</div>