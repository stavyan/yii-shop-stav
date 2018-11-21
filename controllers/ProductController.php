<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 18/11/10
 * Time: 上午9:32
 */

namespace app\controllers;

use app\modules\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class ProductController extends Controller {
    // 当前页面全局不适用模版
    public $layout = false;
    public function actionIndex()
    {
        $this->layout = "layout2";
        $cid = Yii::$app->request->get("cateid");
        $where = "cateid = :cid and ison = '1'";
        $params = [':cid' => $cid];
        $model = Product::find()->where($where, $params);
        $all = $model->asArray()->all();

        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['frontproduct'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $all = $model->offset($pager->offset)->limit($pager->limit)->asArray()->all();

        $tui = $model->Where($where . ' and istui = \'1\'', $params)->orderby('createtime desc')->limit(5)->asArray()->all();
        $hot = $model->Where($where . ' and ishot = \'1\'', $params)->orderby('createtime desc')->limit(5)->asArray()->all();
        $sale = $model->Where($where . ' and issale = \'1\'', $params)->orderby('createtime desc')->limit(5)->asArray()->all();
        return $this->render("index", ['sale' => $sale, 'tui' => $tui, 'hot' => $hot, 'all' => $all, 'pager' => $pager, 'count' => $count]);
    }

    public function actionDetail () {
        // $this->layout = false;
        $this->layout = "layout2";
        return $this->render("detail");
    }
}