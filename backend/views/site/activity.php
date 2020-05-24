<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Histroy';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>History</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <p>
                <?=Html::a('Go Home', ['index'], ['class' => 'btn btn-primary','title' => Yii::t('yii', 'Go Home')])?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'summary',
                    'created_at:datetime',
                ],
            ]); ?>
        </div>
    </div>
</div>
