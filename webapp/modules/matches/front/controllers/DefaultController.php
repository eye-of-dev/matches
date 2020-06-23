<?php

namespace app\modules\matches\front\controllers;

use app\components\LAController;
use app\modules\matches\models\Matches;
use app\modules\matches\models\MatchesSearch;
use yii\web\NotFoundHttpException;

class DefaultController extends LAController
{

    public function actionView($id)
    {

        $model = $this->findModel($id);

        $this->setMeta('Матч: ' . $model->teamHome->title . ' - ' . $model->teamGuest->title);

        return $this->render('view', ['model' => $model]);
    }

    /**
     * Finds the Matches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Matches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Matches::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
