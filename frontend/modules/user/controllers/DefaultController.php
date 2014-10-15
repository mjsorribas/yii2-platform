<?php
/**
 * @link https://github.com/menst/yii2-cms.git#readme
 * @copyright Copyright (c) Gayazov Roman, 2014
 * @license https://github.com/menst/yii2-cms/blob/master/LICENSE
 * @package yii2-cms
 * @version 1.0.0
 */

namespace menst\cms\frontend\modules\user\controllers;

use kartik\widgets\Alert;
use menst\models\ObjectModel;
use Yii;
use menst\cms\common\models\User;
use menst\models\Model;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class DefaultController
 * @package yii2-cms
 * @author Gayazov Roman <m.e.n.s.t@yandex.ru>
 */
class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['update', 'index'],
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        /** @var \menst\cms\common\models\User $user */
        $user = Yii::$app->user->getIdentity();

        $model = $this->extractParamsModel($user);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->setParamsArray($model->toArray());

            if ($user->save()) {
                $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash(Alert::TYPE_DANGER, Yii::t('menst.cms', "It wasn't succeeded to keep the user's parameters. Error:\n{error}", ['error' => implode("\n", $user->getFirstErrors())]));
            }
        }

        return $this->render('update', [
            'user' => $user,
            'model' => $model
        ]);
    }

    /**
     * @param $user User
     * @return ObjectModel
     */
    protected function extractParamsModel($user)
    {
        if ($this->module->userParamsClass) {
            try {
                $attributes = $user->getParamsArray();
            } catch(InvalidParamException $e) {
                $attributes = [];
            }

            $model = new ObjectModel($this->module->userParamsClass);
            $model->setAttributes($attributes);

            return $model;
        }
    }
}
