<?php
/**
 * @var $this yii\web\View
 */

/** @var \menst\cms\common\models\MenuItem $menu */
$menu = Yii::$app->menuManager->getActiveMenu();
if ($menu) {
    $this->title = $menu->isProperContext() ? $menu->title : Yii::t('menst.cms', 'Tag cloud');
    $this->params['breadcrumbs'] = $menu->getBreadcrumbs($menu->isApplicableContext());
} else {
    $this->title = Yii::t('menst.cms', 'Tag cloud');
}
//$this->params['breadcrumbs'][] = $this->title;


echo \yii\helpers\Html::tag('h2', \yii\helpers\Html::encode($this->title));

echo \menst\cms\frontend\widgets\TagCloud::widget([
    'id' => 'tag-cloud',
    'language' => Yii::$app->language
]);