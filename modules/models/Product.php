<?php
namespace app\modules\models;
use yii\db\ActiveRecord;
/**
 * 商品模型类
 * Class Product
 * @package app\models
 */
class Product extends ActiveRecord
{
    //七牛参数
    const AK = 'zl4_Y_0nmiKTvAKK5YKQYWaqd6N6uJJXP0VawLII';
    const SK = 'C8qiSaATScaj_iXjkylljYuWwh0VAfsfxEkh--P3';
    const DOMAIN = 'pawukabl7.bkt.clouddn.com';
    const BUCKET = 'zq-edu';
    public function rules()
    {
        return [
            ['title','required','message'=>'标题不能为空'],
            ['descr','required','message'=>'描述不能为空'],
            ['cateid','required','message'=>'商品分类必须选择'],
            ['price','required','message'=>'单价不能为空'],
            [['price','saleprice'],'number','min'=>0.01,'message'=>'价格必须是正数'],
            ['num','integer','min'=>0,'message'=>'库存必须是非负整数'],
            [['issale','ishot','pics','istui'],'safe'],
            [['cover'],'required','message'=>'封面图片必须选择']
        ];
    }
    public function attributeLabels()
    {
        return [
            'cateid' => '分类名称',
            'title'  => '商品名称',
            'descr'  => '商品描述',
            'price'  => '商品价格',
            'ishot'  => '是否热卖',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'num'    => '库存',
            'cover'  => '图片封面',
            'pics'   => '商品图片',
            'ison'   => '是否上架',
            'istui'   => '是否推荐',
        ];
    }
    public static function tableName()
    {
        return "{{%product}}";
    }
    /**
     * 添加商品
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['cateid'=>'cateid']);
    }

    /**
     * Returns static class instance, which can be used to obtain meta information.
     * @param bool $refresh whether to re-create static instance even, if it is already cached.
     * @return static class instance.
     */
    public static function instance($refresh = false)
    {
        // TODO: Implement instance() method.
    }
}