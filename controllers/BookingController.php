<?php
namespace app\controllers;
use app\models\Booking;
use app\models\Theatre;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Request;
use yii\web\UploadedFile;

class BookingController extends FunctionController

{
    public $modelClass = 'app\models\Booking';

    public function behaviors()
    {
        /*
         * Указание на аутентификации по токену
         */
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only' => ['booking']
        ];

        return $behaviors;
    }

    public function actionBooking()
    {
        $request = Yii::$app->request->post();
        $users=Yii::$app->user->identity;
        $booking=new Booking($request);
        $booking->idusr=$users->id;
        if (!$booking->validate()) return $this->validation($booking);
        $booking->save(false);

        return $this->send(200,['data'=>['message'=>'Номер забронирован.','Код бронирования:'=>$booking->id]]);
    }

    public function actionDelete($id)
    {
        $booking=Booking::findOne($id);
        if (!$booking)
            return $this->send(404,['message'=>'Бронирование не найдено.']);
        $booking->delete();
        return $this->send(200, ['body'=>'Бронирование удалено.']);
    }
}