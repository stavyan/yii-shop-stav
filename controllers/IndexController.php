<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 18/11/9
 * Time: 下午11:03
 */

namespace app\controllers;

use yii\web\Controller;

class IndexController extends Controller {

    public function actionIndex () {
//        $this->layout = false;
//        return $this->render("index");
        return $this->renderPartial("index");
    }

}
