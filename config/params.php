<?php

return [
    'app.adminEmail' => 'admin@example.com',
    'app.senderEmail' => 'noreply@example.com',
    'app.senderName' => 'Example.com mailer',

    'identity.rememberMeDuration' => 60 * 60 * 24 * 30,
    'identity.minPasswordLength' => 6,
    'identity.maxPasswordLength' => 32,

    'identity.emailConfirmationTimeout' => YII_DEBUG ? 5 : 60 * 5,
    'identity.passwordResetTimeout' => YII_DEBUG ? 5 : 60 * 5,
];
