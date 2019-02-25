<?php

namespace app\models;

use Yii;

class InvApps extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_apps';
    }

    /**
     * Override isDisabled method if you need as shown in the
     * example below. You can override similarly other methods
     * like isActive, isMovable etc.
     */
    /*public function isDisabled()
    {
        if (Yii::$app->user->username !== 'admin') {
            return true;
        }
        return parent::isDisabled();
    }*/
}