<?php
/**
 * Des: 用户订单
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/10 上午9:57
 */

namespace app\controllers;

use yii\web\controller;

class OrderController extends Controller {
    public $layout = false;

    public function actionIndex () {
        $this->layout = "layout2";
        return $this->render("index");
    }

    public function actionCheck () {
        $this->layout = "layout";
        return $this->render("check");
    }
}