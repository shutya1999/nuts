<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 24.07.2021
 * Time: 16:26
 */

namespace app\modules\account\models;


use yii\db\ActiveRecord;

class UserInfo extends ActiveRecord
{
    public $currentPassword;
    public $newPassword;
    public $changePass = false;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password', 'name', 'phone'], 'required'],
            [['surname', 'delivery_type', 'city', 'department_np', 'street', 'index_ukr', 'house_number', 'apartment_number', 'patronymic', 'changePass', 'currentPassword', 'newPassword'], 'safe'],
            ['changePass', 'boolean']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'E-mail',
            'password' => 'Пароль',
            'name' => "Ім'я",
            'phone' => 'Телефон',
            'surname' => 'Прізвище',
            'patronymic' => "Ім'я по батькові",
            'changePass' => 'Змінити пароль'
        ];
    }

    public function deliveryHTML($delType){
        switch ($delType){
            case "Нова Пошта":
                $html = "
                    <div class=\"mo-item__wrap type-delivery__block_wrap\">
                        <div class=\"type-delivery__block novaposhta-wrap active\" data-delivery=\"Нова Пошта\">
                            <div class=\"search-city\">
                                <input type=\"text\" class=\"form-fields city-name\" name=\"UserInfo[city]\" data-ref=\"\" placeholder=\"Введіть місто*\" autocomplete=\"no\" value='$this->city'>
                                <ul class=\"delivery-list city-list hide\"></ul>
                            </div>
                            <div class=\"search-department\">
                                <input type=\"text\" class=\"form-fields department-input\" name=\"UserInfo[department_np]\" placeholder=\"Введіть номер відділення*\" autocomplete=\"no\" value='$this->department_np'>
                                <ul class=\"delivery-list department-list hide\"></ul>
                            </div>
                        </div>
                    </div>
                ";
                break;
            case "Укрпошта":
                $html = "
                    <div class=\"type-delivery__block ukrposhta-wrap\" data-delivery=\"Укрпошта\">
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[patronymic]\" data-ref=\"\" placeholder=\"Ім'я по батькові* \" value='$this->patronymic'>
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[city]\" data-ref=\"\" placeholder=\"Введіть місто*\" value='$this->city'>
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[street]\" placeholder=\"Введіть вулицю*\" value='$this->street'>
                        <input type=\"number\" class=\"form-fields\" name=\"UserInfo[index_ukr]\" placeholder=\"Поштовий індекс*\" value='$this->index_ukr'>
                    </div>
                ";
                break;
            case "Кур’єрська доставка":
                $html = "
                    <div class=\"type-delivery__block courier-wrap\" data-delivery=\"Кур’єрська доставка\">
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[city]\" data-ref=\"\" placeholder=\"Введіть місто*\"  value='$this->city'>
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[street]\" placeholder=\"Введіть вулицю*\"  value='$this->street'>
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[house_number]\" placeholder=\"Будинок*\"  value='$this->house_number'>
                        <input type=\"text\" class=\"form-fields\" name=\"UserInfo[apartment_number]\" placeholder=\"Квартира*\"  value='$this->apartment_number'>
                    </div>
                ";
                break;
            case "Самовивіз":
                $html = "";
                break;
        }

        return $data = ['type' => $delType, 'HTML' => $html];
    }

}