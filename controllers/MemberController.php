<?php
/**
 * Des: 用户控制器
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/10 上午10:08
 */

namespace app\controllers;

use yii\web\controller;

class MemberController extends Controller {
    public function actionAuth () {
        $this->layout = "layout2";
        return $this->render("auth");
    }
}