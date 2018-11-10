<?php
/**
 * Des:
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/10 上午11:21
 */

namespace app\modules\controllers;

use yii\web\Controller;

class PublicController extends Controller {
    public function actionLogin () {
        $this->layout = false;
        return $this->render("login");
    }
}