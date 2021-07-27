<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord
{

    public static function tableName()
    {
        return 'order_product';
    }

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'price', 'qty', 'total', 'volume', 'volume_type'], 'required'],
            [['order_id', 'product_id', 'qty', 'volume'], 'integer'],
            [['price', 'total'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function saveOrderProducts($products, $order_id){

        foreach ($products as $id => $product) {

            $this->id = null;
            $this->isNewRecord = true;

            foreach ($product as $item) {
                if (isset($item['qty'])){

                    $this->order_id = $order_id;
                    $this->product_id = $id;
                    $this->title = $product['title'];
                    $this->price = $item['price'];
                    $this->volume = $item['volume'];
                    $this->qty = $item['qty'];
                    $this->total = $item['qty'] * $item['price'];
                    $this->volume_type = $product['volume-type'];


                    if (!$this->save()){
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function getProduct(){
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

}