<?php
/**
 * Des:
 * Created by PhpStorm.
 * User: stav stavyan@qq.com
 * Time: 18/11/11 下午10:36
 */

namespace app\modules\models;
use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%profile}}";
    }

}