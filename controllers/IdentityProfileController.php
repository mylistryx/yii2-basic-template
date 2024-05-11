<?php

namespace app\controllers;

use app\components\controllers\WebController;
use app\components\user\WebUser;
use app\domain\providers\IdentityProvider;
use app\domain\repositories\IdentityProfileRepository;
use app\domain\services\IdentityProfileService;
use app\forms\identityProfile\CreateProfileForm;
use app\forms\IdentityProfileForm;
use Throwable;
use yii\web\Response;

final class IdentityProfileController extends WebController
{
    private readonly int $identityId;

    public function __construct(
        $id,
        $module,
        private readonly IdentityProfileService $identityProfileService,
        private readonly IdentityProfileRepository $identityProfileRepository,
        IdentityProvider $identityProvider,
        $config = [],
    ) {
        parent::__construct($id, $module, $config);
        $this->identityId = $identityProvider->provide()->id;
    }

    public function actionIndex(): Response
    {
        $model = $this->identityProfileService->findByIdentityId($this->identityId);

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionCreate(): Response
    {
        $model = new IdentityProfileForm($this->identityId);

        if ($model->load($this->post())) {
            try {
                $this->identityProfileService->create($model);

                return $this->redirect(['index']);
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): Response
    {
        $model = new IdentityProfileForm($this->identityId);
        $profile = $this->identityProfileRepository->findByIdentityId($this->identityId);

        if ($model->load($this->post())) {
            try {
                $this->identityProfileService->update($model, $profile);

                return $this->redirect(['index']);
            } catch (Throwable $exception) {
                $this->error($exception->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }
}