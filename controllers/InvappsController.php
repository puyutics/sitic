<?php

namespace app\controllers;

// CONTROLLER - controllers/ProductController.php
class InvappsController extends \yii\web\Controller {
    public function actionIndex()
    {
        return $this->render('index');
    }
}
