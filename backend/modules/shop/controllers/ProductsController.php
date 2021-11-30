<?php

namespace backend\modules\shop\controllers;

use common\models\ProductValues;
use common\models\Products;
use common\models\SearchProducts;
use PHPUnit\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchProducts();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->thumb = UploadedFile::getInstance($model, 'thumb');
                $model->thumb->saveAs('uploads/products/img/product_'. $model->id . '_'. time() .'.' . $model->thumb->extension);
                $model->thumb = 'product_' .$model->id . '_'. time() .'.' . $model->thumb->extension;
                if($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if($model->load($this->request->post())){

                if(UploadedFile::getInstance($model, 'thumb')){
                    $model->thumb = UploadedFile::getInstance($model, 'thumb');
                    $model->thumb->saveAs('uploads/products/img/product_'. $model->id . '_'. time() .'.' . $model->thumb->extension);
                    $model->thumb = 'product_'. $model->id . '_'. time().'.' . $model->thumb->extension;
                }

                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


   /* public function actionAddAttributes($id) {

        $model = $this->findModel($id);
        $attributes_model = AttributesValues::find()->where(['product_id' => $id])->one();
        $attributes_values = array();

        $attributes_list = $model->attributesList();

        if($attributes_model) {
            $attributes_values = unserialize($attributes_model->product_values);

        }else {
            $attributes_model = new AttributesValues();
        }




        if ($this->request->isPost) {
            $attributes_model->load($this->request->post());
            $attributes_model->product_id = $id;
            $attributes_model->product_values = serialize($attributes_model->product_values);
            if ($attributes_model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }


        return $this->render('add_attributes', [
            'attributes_list' => $attributes_list, 'model' => $model, 'attributes_model' => $attributes_model, 'attributes_values' => $attributes_values
        ]);
    }
*/



    public function actionEditAttributes($id) {

        $model = $this->findModel($id);
        $attributes_model = ProductValues::find()->where(['product_id' => $id])->orderBy('sort')->all();
        $attributes_list = $model->attributesList();

        if ($this->request->isAjax) {
            $post = $this->request->post();

            foreach ($post['positions'] as $position) {
                $attributes_model = ProductValues::findOne($position[0]);
                $attributes_model->sort = $position[1];
                $attributes_model->save();
            }
            return true;

        }

        if($attributes_model) {
                if ($this->request->isPost) {
                    $post = $this->request->post();
                    $i = 1;
                    foreach ($post['ProductValues']['value'] as $key => $value){

                        $attributes_model = ProductValues::findOne($key);
                        $attributes_model->value = $value;
                        if ($attributes_model->save()) {
                            $success[] = '<span class="success">Сохранено</span> <br>';
                        }else {
                            $errors[] = '<span class="danger">Ошибка</span> <br>';
                        }
                        $i++;
                    }
                    if(!empty($errors)){
                        Yii::$app->session->setFlash('error',  $errors);
                    }else {
                        Yii::$app->session->setFlash('success',  $success);
                    }
                    return $this->redirect(['view', 'id' => $model->id]);

                }


            return $this->render('update_attributes', ['model' => $model, 'attributes_model' => $attributes_model]);

        }else {
            $attributes_model = new ProductValues();
            $sort = 1;
            if ($this->request->isPost) {
                $post = $this->request->post();
                foreach ($post['ProductValues']['value'] as $key => $value){

                    $attributes_model = new ProductValues();
                    $attributes_model->product_id = $id;
                    $attributes_model->attribut_id = $key;
                    $attributes_model->value = $value;
                    $attributes_model->sort = $sort;
                    $sort++;

                    if ($attributes_model->save()) {
                        $success[] = '<span class="success">Сохранено</span> <br>';
                    }else {
                        $errors[] = '<span class="danger">Ошибка</span> <br>';
                    }
                }
                if(!empty($errors)){
                    Yii::$app->session->setFlash('error',  $errors);
                }else {
                    Yii::$app->session->setFlash('success',  $success);
                }
                return $this->redirect(['view', 'id' => $model->id]);

            }


            return $this->render('add_attributes', [
                'attributes_list' => $attributes_list, 'model' => $model, 'attributes_model' => $attributes_model]);

        }

    }




    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->deleteData()) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionDeleteImage($id){
        $model =  $this->findModel($id);
        if(unlink('uploads/products/img/'. $model->thumb)) {
            $model->thumb = '';
            $model->save();
            return true;
        }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
