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
    Mengoverride cara kerja fungsi create user
    */
    public function actionCreate()
    {
        $model = $this->module->manager->createUser(['scenario' => 'create']);

        if ($model->load(\Yii::$app->request->post()) && $model->create()) {
            
            // ambil data di employee yang baru disimpen
            $employee = Employee::findOne(['user_id' => $model->id]);
            // cek pola username, apakah nip atau tidak
            if (preg_match('/[0-9]{18}/', $model->username) or preg_match('/[0-9]{9}/', $model->username)) {
                // pola nya nip, simpan ke field nip sama name
                $employee->name = $model->username;
                $employee->nip = $model->username;
                $employee->save();
            }
            else
            {
                // otherwise, simpen ke nama
                $employee->name = $model->username;
                $employee->save();
            }

            \Yii::$app->getSession()->setFlash('admin_user', \Yii::t('user', 'User has been created'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /*
    Mengoverride cara kerja fungsi delete user
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