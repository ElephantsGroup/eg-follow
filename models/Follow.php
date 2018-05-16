<?php

namespace elephantsGroup\follow\models;

use Yii;

/**
 * This is the model class for table "{{%eg_follow}}".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $item_id
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $follow
 * @property integer $sort_order
 * @property integer $status
 * @property string $update_time
 * @property string $creation_time
 */
class Follow extends \yii\db\ActiveRecord
{
    public static $_UNFOLLOW = 0;
    public static $_FOLLOW = 1;

    public static function getFollow()
    {
        return [
            self::$_UNFOLLOW => Yii::t('app', 'Unfollow'),
            self::$_FOLLOW => Yii::t('app', 'Follow')
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eg_follow}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip'], 'trim'],
            [['item_id', 'service_id', 'user_id', 'follow'], 'integer'],
            [['update_time', 'creation_time'], 'date', 'format'=>'php:Y-m-d H:i:s'],
            [['ip'], 'string', 'max' => 32],
            [['follow'], 'default', 'value' => self::$_UNFOLLOW],
            [['item_id', 'service_id'], 'default', 'value' => 0],
            [['update_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['creation_time'], 'default', 'value' => (new \DateTime)->setTimestamp(time())->setTimezone(new \DateTimeZone('Iran'))->format('Y-m-d H:i:s')],
            [['follow'], 'in', 'range' => array_keys(self::getFollow())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $base = Yii::$app->getModule('base');
        return [
            'id' => $base::t('ID'),
            'ip' => $base::t('IP'),
            'item_id' => $base::t('Item ID'),
            'service_id' => $base::t('Service ID'),
            'user_id' => $base::t('User ID'),
            'follow' => $base::t('Follow'),
            'update_time' => $base::t('Update Time'),
            'creation_time' => $base::t('Creation Time'),
        ];
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $date->setTimestamp(time());
        $date->setTimezone(new \DateTimezone('Iran'));
        $this->update_time = $date->format('Y-m-d H:i:s');
        if($this->isNewRecord)
            $this->creation_time = $date->format('Y-m-d H:i:s');
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     * @return \common\models\FollowQuery the active query used by this AR class.
     */
    /*public static function find()
    {
        return new \common\models\FollowQuery(get_called_class());
    }*/
}
