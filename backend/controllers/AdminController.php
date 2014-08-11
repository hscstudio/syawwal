<?php
namespace backend\controllers;

use dektrium\user\controllers\AdminController as BaseAsdAdminController;
use backend\models\UserSearch;

class AdminController extends BaseAsdAdminController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new UserSearch();
        $dataProvider = $searchModel->search($_GET);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
}