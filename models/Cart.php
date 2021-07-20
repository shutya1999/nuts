<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 22.06.2021
 * Time: 12:28
 */

namespace app\models;


use yii\base\Model;

/*

[

]

*/

$arr = [
    'cart' => [
        '2' => [
            'title' => '',
            'img' => '',
            'url' => '',
            '2000' => [
                'volume' => '2000',
                'price' => '1500'
            ],
            '500' => [
                'volume' => '500',
                'price' => '200'
            ]
        ]
    ],
    'cart.qty' => '',
    'cart.sum' => ''
];


class Cart extends Model
{
    public function addToCart($product, $volume, $qty){

        $options = json_decode($product->option);
        foreach (current($options) as $key => $option){
            if ($option->quantity == $volume){
                $price = $option->price * $qty;
            }
        }
        if (isset($_SESSION['cart'][$product->id])){
            if (isset($_SESSION['cart'][$product->id][$volume])){
                $_SESSION['cart'][$product->id][$volume]['qty'] += $qty;
            }else{
                $_SESSION['cart'][$product->id][$volume] = [
                    'price'       => $price,
                    'volume'      => $volume,
                    'qty'         => $qty
                ];
            }
        }else{
            $_SESSION['cart'][$product->id] = [
                'title'       => $product->title,
                'img'         => $product->img,
                'url'         => $product->url,
                'volume-type' => key($options),
            ];
            $_SESSION['cart'][$product->id][$volume] = [
                'price'       => $price,
                'volume'      => $volume,
                'qty'         => $qty
            ];
        }
        $totalPrice = 0;
        $totalQty = 0;

        foreach ($_SESSION['cart'] as $goods){
            foreach ($goods as $item){
                if (isset($item['qty'])){
                    $totalPrice = $totalPrice + ($item['qty'] * $item['price']);
                    $totalQty = $totalQty + $item['qty'];
                }
            }
        }

        $_SESSION['cart.sum'] = $totalPrice;
        $_SESSION['cart.qty'] = $totalQty;

//        debug($_SESSION['cart']);
    }

    public function changeCart($id, $volume, $qty){
        $_SESSION['cart'][$id][$volume]['qty'] = $qty;
//        $_SESSION['cart'][$id][$volume]['price'] = $qty;


        $totalPrice = 0;
        $totalQty = 0;

        foreach ($_SESSION['cart'] as $goods){
            foreach ($goods as $item){
                if (isset($item['qty'])){
                    $totalPrice = $totalPrice + ($item['qty'] * $item['price']);
                    $totalQty = $totalQty + $item['qty'];
                }
            }
        }

        $_SESSION['cart.sum'] = $totalPrice;
        $_SESSION['cart.qty'] = $totalQty;

    }

    public function recalc($id, $volume){

        if (!isset($_SESSION['cart'][$id])){
            return false;
        }

        $qtyMinus = 0;
        $priceMinus = 0;

        foreach ($_SESSION['cart'][$id] as $key => $item) {
            if (isset($item['qty']) && $key == $volume) {
                $priceMinus = $priceMinus + ($item['qty'] * $item['price']);
                $qtyMinus = $qtyMinus + $item['qty'];
            }
        }

        $_SESSION['cart.sum'] -= $priceMinus;
        $_SESSION['cart.qty'] -= $qtyMinus;

        unset($_SESSION['cart'][$id][$volume]);

        if (count($_SESSION['cart'][$id])< 4){
            unset($_SESSION['cart'][$id]);
        }
    }
}