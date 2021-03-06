<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 14.06.2021
 * Time: 18:31
 */

namespace app\controllers;


use app\models\BannerCatalog;
use app\models\Category;
use app\models\Product;
use app\models\SortForm;
use yii\web\Response;

class CategoryController extends AppController
{
    public $my_var;

    public function actionView($id){
        $category = Category::findOne($id);
        $categories = Category::find()->all();

        $banner = BannerCatalog::find()->all();


        $this->setMeta("{$category->name} - " . \Yii::$app->name, $category->keywords, $category->description);
        $this->view->registerMetaTag(["property" => 'og:title', 'content' => "{$category->name} - " . \Yii::$app->name]);

        $model = new SortForm();

        $model->load(\Yii::$app->request->post());
        if (\Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;

                $lower_price = 0;
                $top_price = 99999;

                if ($model->lower_price){
                    $lower_price = $model->lower_price;
                }
                if ($model->top_price){
                    $top_price = $model->top_price;
                }
                if ($model->category != ""){
                    $catID = [];
                    foreach ($model->category as $item) {
                        $catID[] = Category::find()->where(['url' => $item])->one()->id;
                    }
                }else{
                    foreach(Category::find()->select(['id'])->asArray()->all() as $item){
                        $catID[] = $item["id"];
                    }
                }

                $products = Product::find()
                    ->where(['category_id' => $catID,])
                    ->andWhere('price >= :low_price AND price <= :top_price', [
                        ':low_price' => $lower_price,
                        ':top_price' => $top_price,
                    ])
                    ->orderBy($this->sortType($model->sort))
                    ->all();

                    return $products;
        }else{
            $products = Product::find()->where(['category_id' => $id])->all();
        }

        return $this->render("view", compact(['products', 'categories', 'pages', 'model', 'banner']));
    }

    public function sortType($sort_type){
        switch ($sort_type) {
            case 'price-up':
                return ['price' => SORT_ASC];
                break;
            case 'price-down':
                return ['price' => SORT_DESC];
                break;
            case 'popular':
                return ['number_orders' => SORT_DESC];
                break;
        }
    }
}