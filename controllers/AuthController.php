<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\forms\auth\LoginForm;
use app\services\AuthService;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

final class AuthController extends WebController
{
    public function __construct(
        $id,
        $module,
        private readonly AuthService $authService,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function actionIndex(): Response
    {
        $model = Yii::createObject(LoginForm::class);

        if ($model->load($this->post())) {
            try {
                $model->validateOrPanic();
                $this->authService->login($model);
                return $this->goBack();
            } catch (Throwable $exception) {
                $model->password = null;
                $this->error($exception->getMessage());
            }
        }
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        try {
            $this->authService->logout();
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());
        }

        return $this->goHome();
    }
}