<?php

namespace elephantsGroup\follow\controllers;

use Yii;
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
class BaseAjaxController extends EGController
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

    public function actionAdd()
    {
        $follow_module = \Yii::$app->getModule('follow');
        $response = [
            'status' => 500,
            'message' => $follow_module::t('Server problem')
        ];

        try
        {
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
            $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : 0;
            $user_id = Yii::$app->user->isGuest ? 0 : (int) Yii::$app->user->id;
            $ip = Yii::$app->request->userIP;

            $follow = Follow::find()
                ->where(['item_id' => $item_id, 'service_id' => $service_id, 'user_id' => $user_id, 'follow' => Follow::$_FOLLOW])
                ->one();

            if(!$follow)
            {
                $model = new Follow();
                $model->service_id = $service_id;
                $model->item_id = $item_id;
                $model->user_id = $user_id;
                $model->follow = Follow::$_FOLLOW;
                $model->ip = $ip;

                if($model->save())
                {
                    $response = [
                        'status' => 200,
                        'message' => $follow_module::t('Successful')
                    ];
                    $this->additionalFeatureAdd();
                }
                else
                    $response = [
                        'status' => 400,
                        'message' => $follow_module::t('Failed to save')
                    ];
            }
            else
                $response = [
                    'status' => 200,
                    'message' => $follow_module::t('Followed before')
                ];
        }
        catch(Exception $exp)
        {
            $response = [
                'status' => 500,
                'message' => $follow_module::t('Server problem')
            ];
        }
        return json_encode($response);
    }

    public function actionRemove()
    {
        $follow_module = Yii::$app->getModule('follow');
        $response = [
            'status' => 500,
            'message' => $follow_module::t('Server problem')
        ];

        try
        {
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : 0;
            $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : 0;
            $user_id = Yii::$app->user->isGuest ? 0 : (int) Yii::$app->user->id;

            $follow = Follow::find()
                ->where(['item_id' => $item_id, 'service_id' => $service_id, 'user_id' => $user_id, 'follow' => Follow::$_FOLLOW])
                ->orderBy(['id' => SORT_DESC])
                ->one();

            if($follow)
            {
                $follow->follow = Follow::$_UNFOLLOW;
                if($follow->save())
                {
                    $response = [
                        'status' => 200,
                        'message' => $follow_module::t('Successful')
                    ];
                    $this->additionalFeatureRemove();
                }
                else
                    $response = [
                        'status' => 400,
                        'message' => $follow_module::t('Failed to unfollow')
                    ];
            }
            else
                $response = [
                    'status' => 200,
                    'message' => $follow_module::t('Does not followed before')
                ];
        }
        catch(Exception $exp)
        {
            $response = [
                'status' => 500,
                'message' => $follow_module::t('Server problem')
            ];
        }
        return json_encode($response);
    }
}
