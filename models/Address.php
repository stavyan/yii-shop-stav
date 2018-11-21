<?php
/**
 * Created by PhpStorm.
 * User: stav
 * Date: 2018/11/21
 * Time: 下午10:55
 */
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Address extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%address}}";
    }

    public function rules()
    {
        return [
            [['userid', 'firstname', 'lastname', 'address', 'email', 'telephone'], 'required'],
            [['createtime', 'postcode'],'safe'],
        ];
    }
}
