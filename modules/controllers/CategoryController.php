<?php
/**
 * des 模块分类
 * User: stav
 * Date: 2018/11/18
 * Time: 下午3:22
 */


namespace app\modules\controllers;

use app\modules\models\Category;
use yii\web\Controller;
use Yii;

class CategoryController extends Controller
{

    public function actionList()
    {
        $this->layout = "layout";
        return $this->render("cates");
    }

    public function actionAdd()
    {
        $model = new Category();
        $list = $model->getOptions();
        $this->layout = "layout";
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->add($post)) {
                Yii::$app->session->setFlash("info", '添加分类成功');
            }
        }
        return $this->render("add", ['list' => $list, 'model' => $model]);
    }

}

?>
