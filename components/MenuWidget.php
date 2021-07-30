<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 12.06.2021
 * Time: 14:43
 */
namespace app\components;

use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl;//шаблон
    public $ul_class;//class
    public $data;//данные из БД
    public $tree;
    public $menuHtml;

    public function init()
    {
        parent::init();
        if ($this->ul_class === null){
            $this->ul_class = "menu";
        }
        if ($this->tpl === null){
            $this->tpl = "menu";
        }
        $this->tpl .= '.php';
    }
    public function run()
    {
        $this->data = Category::find()->indexBy('id')->asArray()->all();

        $this->menuHtml = "
            <ul class='nav df'>
                <li class='nav-list sub'>
                    <p class='nav-link'>Каталог товарів</p>
                    <ul class='" . $this->ul_class ."'>";
                        $this->menuHtml .= $this->getMenuHtml($this->data);
                    $this->menuHtml .= "
                    </ul>
                </li>
                <li class='nav-list'><a href='/#review' class='nav-link'>Відгуки</a></li>
                <li class='nav-list'><a href='/home/delivery' class='nav-link'>Доставка і оплата</a></li>
                <li class='nav-list'><a href='/#contacts' class='nav-link'>Контакти</a></li>
            </ul>
            ";

//        debug($this->data);
        return $this->menuHtml ;
    }
    protected function getMenuHtml($data){
        $str = '';
        foreach ($data as $category){
            $str .= $this->CatToTemplate($category);
        }
        return $str;
    }

    protected function CatToTemplate($category){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;

        return ob_get_clean();

    }



}