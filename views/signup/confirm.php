<?php

/**
 * @var View $this
 * @var ActiveForm $form
 * @var ConfirmEmailForm $model
 */

use app\forms\signup\ConfirmEmailForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'Confirm email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resend-confirmation-token">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to set your password:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'passwordConfirmation')->passwordInput() ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Save my password', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
