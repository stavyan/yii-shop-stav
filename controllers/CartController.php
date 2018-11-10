<?php
/**
 * Des:
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/10 上午9:52
 */

namespace app\controllers;

use yii\web\controller;

class CartController extends Controller {
    public function actionIndex () {
        $this->layout = 'layout';
        return $this->render("index");
    }
}