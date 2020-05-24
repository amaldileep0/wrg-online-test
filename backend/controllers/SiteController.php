<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\search\ResourceSearch;
use common\models\search\ResourceLogSearch;
use common\models\Resource;
use yii\web\UploadedFile;
use common\models\ResourceLog;

/**
 * Site controller
 */
class SiteController extends Controller
{
   
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResourceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Resource();
        if (Yii::$app->request->isPost) {
            $model->file_path = UploadedFile::getInstance($model, 'file_path');
            $model->file_type = $model->file_path->extension;
            if ($model->file_path && $model->validate()) {
                $basePath  = sprintf(Yii::getAlias('@resource')."%s","/");
                if(!file_exists($basePath)){
                    mkdir($basePath,0777,true);
                }
                $model->file_path->saveAs($basePath . $model->file_path->baseName . '.' . $model->file_path->extension);
                $model->file_path = $model->file_path->name;
                if($model->save(false)) {
                    $model->logupload();
                    Yii::$app->session->setFlash('success', 'File Uploaded Successfully.');
                    return $this->goHome();
                } else {

                }
             }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing resource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionDelete($id)
    {   
        $model = $this->findModel($id);

        $basePath  = sprintf(Yii::getAlias('@resource')."%s","/");
        
        if(file_exists($basePath.$model->file_path)){
           unlink($basePath.$model->file_path);
        }
        $model->logDelete();
        if($model->delete()) {
            Yii::$app->session->setFlash('success', 'File deleted Successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Sorry unable to delete requested file');
        }
    
        return $this->redirect(['index']);
    }

    /**
     * Finds the resource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return resource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resource::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionResourceActivity()
    {
        $searchModel = new ResourceLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('activity', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
