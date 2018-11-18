<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 2018/11/18
 * Time: 下午3:52
 */
namespace app\modules\controllers;

use app\modules\controllers\CommonController;

class DefaultController extends CommonController
{
    public function actionIndex()
    {
        $this->layout = "layout";
        return $this->render('index');
    }
}

