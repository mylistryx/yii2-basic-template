<?php

namespace app\modules\comments\controllers;

use app\components\controllers\WebController;
use app\modules\comments\models\Comment;
use app\modules\comments\models\CommentSearch;
use Throwable;
use Yii;
use yii\base\Model;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

final class AdminController extends WebController
{
    public function actionIndex(): Response
    {
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): Response
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionApprove(int $id): Response
    {
        $model = $this->findModel($id);
        $model->approve();
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionReject(int $id): Response
    {
        $model = $this->findModel($id);
        $model->reject();
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function findModel(int $id): Comment
    {
        return Comment::findOne($id) ?? throw new NotFoundHttpException();
    }
}