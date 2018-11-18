<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 2018/11/18
 * Time: 下午9:32
 */

namespace app\modules\controllers;

use app\modules\models\Category;
use app\modules\models\Product;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use crazyfd\qiniu\Qiniu;

class ProductController extends Controller {

    public function actionList() {
        $model = Product::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $products = $model->offset($pager->offset)->limit($pager->limit)->all();
        $this->layout = "layout";
        return $this->render("products", ['pager' => $pager, 'products' => $products]);
    }

    public function actionAdd() {
        $this->layout = "layout";
        $model = new Product();
        $cate = new Category();
        $list = $cate-> getOptions();
        unset($list[0]);

        if (Yii::$app->request->isPost){
           $post = Yii::$app->request->post();
            $pics = $this->upload();
            if (!$pics) {
               $model -> addError('cover', '封面不能为空');
            } else {
                $post['Product']['cover'] = $pics['cover'];
                $post['product']['pics'] = $pics['pics'];
            }
            if ($pics && $model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }
        }

        return $this->render("add", ['opts' => $list, 'model' => $model]);
    }

    private function upload() {
        if ($_FILES['Product']['error']['cover'] > 0){
            return false;
        }
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = uniqid();
        try {
            $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
        } catch (\Exception $e) {
        }
        $cover = $qiniu->getLink($key);
        $pics = [];
        foreach ($_FILES['Product']['tmp_name']['cover'] as $k => $file) {
            if ($_FILES['Product']['error']['pics'][$k] > 0) {
                continue;
            }
            $key = uniqid();
            try {
                $qiniu->uploadFile($file, $key);
            } catch (\Exception $e) {
            }
            $pics[$key] =  $qiniu->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }
}