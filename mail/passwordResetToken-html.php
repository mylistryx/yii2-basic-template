<?php
/**
 * @var View $this
 * @var string $resetLink
 */

use yii\helpers\Html;
use yii\web\View;

?>
<div class="password-reset">
    <p>Follow the link below to reset your password:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
