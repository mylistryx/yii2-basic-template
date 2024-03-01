<?php

namespace app\modules\news\controllers;

use app\components\controllers\WebController;
use app\modules\news\models\News;
use app\modules\news\models\NewsSearch;
use Yii;
use yii\web\Response;

final class SiteController extends WebController
{
  public function actionIndex(): Response
  {
    $searchModel = new NewsSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionCreate(): Response
  {

  }

  public function actionView(int $id): Response
  {
    $model = $this->findModel(News::class, $id);

    return $this->render('view', ['model' => $model]);
  }
}