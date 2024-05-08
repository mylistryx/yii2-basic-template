<?php

/**
 * @var View $this
 * @var ActiveForm $form
 * @var ResendEmailConfirmationTokenForm $model
 */

use app\forms\signup\ResendEmailConfirmationTokenForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'Resend confirmation token';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resend-confirmation-token">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following field to resend confirmation token:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Resend confirmation token', ['class' => 'btn btn-primary', 'name' => 'resend-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <div style="color:#999;">
                To reset password use this <?= Html::a('page', ['password-reset/request']) ?>.
            </div>

        </div>
    </div>
</div>
