<?php
namespace app\controllers;
use app\models\Theatre;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Request;
use yii\rest\ActiveController;
use yii\web\UploadedFile;

class TheatreController extends FunctionController
{
    public $modelClass = 'app\models\Theatre';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['create'] //Перечислите для контроллера методы, требующие аутентификации
        ];

        return $behaviors;
    }


    public function actionCreate()
    {
        $request = Yii::$app->request->post();
        $theatres=new Theatre($request);
        if (!$theatres->validate()) return $this->validation($theatres);
        $theatres->save();

        return $this->send(200,['data'=>['message'=>'Театр успешно добавлен!']]);
    }

    public function getBooking()
    {
        return $this->hasMany(Booking::className(), ['id' => 'id']);
    }

    public function actionSearchh()
    {
        $theatres=Theatre::find()->all();
        return $this->send(200,['data'=>['orders'=>$theatres]]);
    }

    public function actionDelete($id)
    {
        $theatres = Theatre::findOne($id);
        $theatres->delete();
        return $this->send(200, ['content'=> ['Status'=>'ok']]);
    }
}