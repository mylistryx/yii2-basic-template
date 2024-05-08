<?php
/**
 * @var View $this
 * @var IdentityProfileForm $model
 */

use app\forms\IdentityProfileForm;
use kartik\widgets\DatePicker;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'patronymic')->textInput() ?>
<?= $form->field($model, 'surname')->textInput() ?>
<?= $form->field($model, 'birthday')->textInput()->widget(DatePicker::class, [
    'options' => [
        'placeholder' => 'Дата',
    ],
    'pluginOptions' => [
        'autoclose' => true,
        'forceParse' => true,
        'format' => 'yyyy-mm-dd',
    ],
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save profile', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>