<?php
/**
 * Des: 用户控制器
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/10 上午10:08
 */
namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;


class MemberController extends Controller
{
    public function actionAuth()
    {
        $this->layout = 'layout2';
        if (Yii::$app->request->isGet) {
            $url = Yii::$app->request->referrer;
            if (empty($url)) {
                $url = "/";
            }
            Yii::$app->session->setFlash('referrer', $url);
        }
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $url = Yii::$app->session->getFlash('referrer');
                return $this->redirect($url);
            }
        }
        return $this->render("auth", ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::$app->session->remove('loginname');
        Yii::$app->session->remove('isLogin');
        if (!isset(Yii::$app->session['isLogin'])) {
            return $this->goBack(Yii::$app->request->referrer);
        }
    }

    public function actionReg()
    {
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->regByMail($post)) {
                Yii::$app->session->setFlash('info', '电子邮件发送成功');
            }
        }
        $this->layout = 'layout2';
        return $this->render('auth', ['model' => $model]);
    }

    public function actionQqlogin()
    {
        require_once("../vendor/API/qqConnectAPI.php");
        $qc = new \QC();
        $qc->qq_login();
    }

    public function actionQqcallback()
    {
//        require_once("../vendor/API/qqConnectAPI.php");
//        $auth = new \OAuth();
//        $accessToken = $auth->qq_callback();
//        $openid = $auth->get_openid();
//        $qc = new \QC($accessToken, $openid);
//        $userinfo = $qc->get_user_info();
//        $session = Yii::$app->session;
//        $session['userinfo'] = $userinfo;
//        $session['openid'] = $openid;
//        if ($model = User::find()->where('openid = :openid', [':openid' => $openid])->one()) {
//            $session['loginname'] = $model->username;
//            $session['isLogin'] = 1;
//            return $this->redirect(['index/index']);
//        }
        $this->layout = 'layout2';
        require_once("../vendor/API/qqConnectAPI.php");
        $qc = new \QC();
        echo $qc->qq_callback();
        echo $qc->get_openid();
    }
//
//    public function actionQqreg()
//    {
//        $this->layout = "layout2";
//        $model = new User;
//        if (Yii::$app->request->isPost) {
//            $post = Yii::$app->request->post();
//            $session = Yii::$app->session;
//            $post['User']['openid'] = $session['openid'];
//            if ($model->reg($post, 'qqreg')) {
//                $session['loginname'] = $post['User']['username'];
//                $session['isLogin'] = 1;
//                return $this->redirect(['index/index']);
//            }
//        }
//        return $this->render('qqreg', ['model' => $model]);
//    }

}
