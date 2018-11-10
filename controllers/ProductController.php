<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 18/11/10
 * Time: 上午9:32
 */

namespace app\controllers;

use yii\web\Controller;

class ProductController extends Controller {
    // 当前页面全局不适用模版
    public $layout = false;
    public function actionIndex () {
        // $this->layout = false;
        // view/product/index.php
        $this->layout = "layout2";
        return $this->render("index");
    }

    public function actionDetail () {
        // $this->layout = false;
        $this->layout = "layout2";
        return $this->render("detail");
    }
}