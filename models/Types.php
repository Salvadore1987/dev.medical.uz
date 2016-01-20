<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/18/16
 * Time: 6:02 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Types extends ActiveRecord {

    public $id;
    public $name;

    public static function getData() {
        $data = self::find()
            ->asArray()
            ->all();
        return $data;
    }

}