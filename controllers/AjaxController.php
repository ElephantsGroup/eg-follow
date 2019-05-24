<?php

namespace elephantsGroup\follow\controllers;

use Yii;
use elephantsGroup\follow\controllers\BaseAjaxController;
use elephantsGroup\follow\models\Follow;
use elephantsGroup\follow\models\FollowSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use elephantsGroup\base\EGController;

/**
 * AdminController implements the CRUD actions for follow model.
 */
class AjaxController extends BaseAjaxController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['POST'],
                    'remove' => ['POST'],
                ],
            ],
        ];
    }

    public function additionalFeatureAdd($service_id, $item_id, $user_id)
    {

    }

    public function additionalFeatureRemove($service_id, $item_id, $user_id)
    {

    }

}
