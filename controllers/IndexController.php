<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 18/11/9
 * Time: 下午11:03
 */

namespace app\controllers;

use app\modules\models\Product;

class IndexController extends CommonController {

    public function actionIndex () {
          // 关闭布局
        $this->layout = 'layout';

        // 渲染页面
        $data['tui'] = Product::find()->where('istui = "1" and ison = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['new'] = Product::find()->where('ison = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['hot'] = Product::find()->where('ison = "1" and ishot = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['all'] = Product::find()->where('ison = "1"')->orderby('createtime desc')->limit(7)->all();
        return $this->render("index", ['data' => $data]);
    }

}
