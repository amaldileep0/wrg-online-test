<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'Online Test';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>File Listing</h1>
    </div>

    <div class="body-content">
        <div class="row">
            <p class="pull-right">
                <?=Html::a('<i class="glyphicon glyphicon-plus"></i> Upload File', ['create'], ['class' => 'btn btn-success','title' => Yii::t('yii', 'Upload New File')])?>
            </p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(['method'=> 'get']); ?>
                    <div class="col-md-5 col-md-offset-3 col-sm-4 col-sm-offset-3">
                        <?= $form->field($searchModel, 'search_term')->textInput(['placeholder' => 'Please enter a keyword to search'])->label(false) ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="row">
            <p>
                <?=Html::a('Show History', ['resource-activity'], ['class' => 'btn btn-primary','title' => Yii::t('yii', 'History')])?>
            </p>
        	<?= GridView::widget([
			    'dataProvider' => $dataProvider,
			    'columns' => [
			        'id',
			        [
                        'attribute' => 'file_path',
                        'label' => 'File'
                    ],
			        [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model,$key) {
                                    return Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('yii', 'Delete'),
                                    "data-confirm" => "Are you sure you want to delete this file?", "data-method"=> "post"]);
                                }, 
                            ],
                    ],
			    ],
			]); ?>
        </div>
    </div>
</div>
