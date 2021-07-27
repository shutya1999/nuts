<?php
/**
 * Created by PhpStorm.
 * User: romai
 * Date: 12.06.2021
 * Time: 12:10
 */

namespace app\controllers;

use app\models\BannerMain;
use app\models\Category;
use app\models\Instagram;
use app\models\Product;
use app\models\PriceForm;
use yii\web\Response;



class HomeController extends AppController
{
    public function actionMyerror()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $statusCode = $exception->statusCode;
            $name = $exception->getName();
            $message = $exception->getMessage();
            $this->layout = false;
            return $this->render('error', [
                'exception' => $exception,
                'statusCode' => $statusCode,
                'name' => false,
                'message' => $message
            ]);
        }
    }

    public function actionIndex(){
        $offers = Product::find()->where(['is_offer' => 1])->limit(10)->all();
        $categories = Category::find()->where(['is_main' => 1])->all();
        $banner = BannerMain::find()->all();

        $insta = Instagram::findOne(1);

        $accessToken = $insta->access_token;
        $tokenDate = $insta->created_at;

        $tokenTimestamp = strtotime($tokenDate);
        $curTimestamp = time();
        $dayDiff = ($curTimestamp - $tokenTimestamp) / 86400;

        if (!empty($accessToken)) {
            if ($dayDiff > 50) { // Если токену уже более 50 дней, то обновляем его
                $url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=" . $accessToken;
                $instagramCnct = curl_init(); // инициализация cURL подключения
                curl_setopt($instagramCnct, CURLOPT_URL, $url); // адрес запроса
                curl_setopt($instagramCnct, CURLOPT_RETURNTRANSFER, 1); // просим вернуть результат
                $response = json_decode(curl_exec($instagramCnct)); // получаем и декодируем данные из JSON
                curl_close($instagramCnct); // закрываем соединение

                $insta->access_token = $response->access_token;
                $insta->created_at = date('Y-m-d');
                $insta->save();
            }

            $url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption,timestamp,thumbnail_url,permalink,children{fields=id,media_url,thumbnail_url,permalink}&limit=9&access_token=" . $insta->access_token;
            $instagramCnct = curl_init(); // инициализация cURL подключения
            curl_setopt($instagramCnct, CURLOPT_URL, $url); // адрес запроса
            curl_setopt($instagramCnct, CURLOPT_RETURNTRANSFER, 1); // просим вернуть результат
            $media = json_decode(curl_exec($instagramCnct)); // получаем и декодируем данные из JSON
            curl_close($instagramCnct); // закрываем соединение

            $instaFeed = array();
            foreach ($media->data as $mediaObj) {
                $instaFeed[$mediaObj->id]['img'] = $mediaObj->thumbnail_url ?: $mediaObj->media_url;
                $instaFeed[$mediaObj->id]['link'] = $mediaObj->permalink;
            }

        }

        return $this->render("index", compact(['offers', 'categories', 'banner', 'instaFeed']));
    }

    public function actionPrivacyPolicy(){
        return $this->render("privacy-policy");
    }
}