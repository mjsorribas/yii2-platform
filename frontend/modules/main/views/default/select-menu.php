<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var menst\cms\backend\modules\menu\models\MenuTypeSearch $searchModel
 */

$this->title = Yii::t('menst.cms', 'Select Menu');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

	<?/*<h1><?= Html::encode($this->title) ?></h1>*/?>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
        'id' => 'grid',
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
        ],
		'columns' => [
            [
                'attribute' => 'id',
                'width' => '50px'
            ],
            [
                'attribute' => 'title',
                'value' => function($model) {
                        /** @var $model \menst\cms\common\models\MenuType */
                        return $model->title . '<br/>' . Html::tag('small', $model->alias, ['class' => 'text-muted']);
                    },
                'format' => 'html'

            ],
            [
                'value' => function($model) {
                    return Html::a(Yii::t('menst.cms', 'Select'), '#', [
                        'class' => 'btn btn-primary btn-xs',
                        'onclick' => \menst\widgets\ModalIFrame::emitDataJs([
                                'id' => $model->id,
                                'description' => Yii::t('menst.cms', 'Menu Type: {title}', ['title' => $model->title]),
                                'value' => $model->id . ':' . $model->alias
                            ]),
                    ]);
                },
                'format'=>'raw'
            ]
		],
        'responsive' => true,
        'hover' => true,
        'condensed' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => 0],
        'bordered' => false,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> ' . Html::encode($this->title) . ' </h3>',
            'type' => 'info',
            'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> ' . Yii::t('menst.cms', 'Reset List'), [null], ['class' => 'btn btn-info']),
            'showFooter' => false,
        ],
	]) ?>

</div>