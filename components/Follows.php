<?php

namespace elephantsGroup\follow\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use elephantsGroup\follow\models\Follow;

class Follows extends Widget
{
	public $language;
    public $service;
    public $item;
    public $color = 'black';
    public $view_file = 'follows';

	public function init()
	{
		if(!isset($this->language) || !$this->language)
			$this->language = Yii::$app->language;
        if(!isset($this->item) || !$this->item)
            $this->item = 0;
        if(!isset($this->service) || !$this->service)
            $this->service = 0;
        if(!isset($this->view_file) || !$this->view_file)
            $this->view_file = Yii::t('follow', 'View File');
	}

    public function run()
	{
        $user_id = (int) Yii::$app->user->id;
        $is_follow = Follow::find()->where(['item_id' => $this->item, 'service_id' => $this->service, 'user_id' => $user_id, 'follow' =>1 ])->one();

        return $this->render($this->view_file, [
            'item' => $this->item,
            'service' => $this->service,
            'color' => $this->color,
            'is_follow' => $is_follow,
        ]);
	}
}