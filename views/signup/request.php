<?php

/**
 * @var View $this
 * @var ActiveForm $form
 * @var SignupRequestForm $model
 */

use app\forms\signup\SignupRequestForm;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

$this->title = 'Signup request';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-request">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following field to signup:</p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Request signup', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <div style="color:#999;">
                You may resend confirmation token on this <?= Html::a('page', ['signup/resend']) ?>.<br>
                To reset password use this <?= Html::a('page', ['password-reset/request']) ?>.
            </div>

        </div>
    </div>
</div>
