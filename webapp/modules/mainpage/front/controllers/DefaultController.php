<?php

namespace app\modules\mainpage\front\controllers;

use app\components\LAController;

class DefaultController extends LAController {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionError() {
        return $this->render('error');
    }

}
