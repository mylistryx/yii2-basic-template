<?php
/**
 * @var View $this
 * @var string $verifyLink
 */

use yii\helpers\Html;
use yii\web\View;


?>
<div class="verify-email">
    <p>Follow the link below to verify your email:</p>
    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
