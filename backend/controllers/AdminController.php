<?php
namespace backend\controllers;

use dektrium\user\controllers\AdminController as BaseAsdAdminController;
use backend\models\UserSearch;
use backend\models\User;
use backend\models\Employee;

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

    /*
    fajar - Mengoverride cara kerja fungsi delete user
    Jadi, ketika menghapus di salah satu tabel, relasinya juga kehapus
    */
    public function actionDelete($id)
    {
        // hapus user dulu
        $user = User::findOne($id);
        $user->delete();

        // hapus employee
        $employee = Employee::findOne(['user_id' => $id]);
        $employee->delete();

        \Yii::$app->getSession()->setFlash('admin_user', \Yii::t('user', 'User has been deleted'));

        return $this->redirect(['index']);
    }
}