<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Resouce */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'File Upload';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'upload-form','options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'file_path')->fileInput(['class' => 'form-control'])->label(); ?> 
                <div class="form-group">
                    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary', 'name' => 'upload-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
