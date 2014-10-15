<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model menst\cms\common\models\Page */
/* @var $sourceModel menst\cms\common\models\Page */

$this->title = Yii::t('menst.cms', 'Add Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('menst.cms', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sourceModel' => $sourceModel
    ]) ?>

</div>
