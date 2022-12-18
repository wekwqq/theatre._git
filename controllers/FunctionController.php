<?php
namespace app\controllers;
use yii\rest\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/*Опишите здесь действия, которые приходится
часто рсуществлять*/

class FunctionController extends Controller{


    /* Подготовка и отправка ответа*/
    public function send($code, $data){
        $response=$this->response;
        $response->format = Response::FORMAT_JSON;
        header('Access-Control-Allow-Origin: *');
        $response->data=$data;
        $response->statusCode=$code;
        return $response;
    }

    /* Формирование и отправка ошибок валидации*/
    public function validation($model){
        $error=['error'=> ['code'=>422, 'message'=>'Validation error',
            'errors'=>ActiveForm::validate($model)]];
        return $this->send(422, $error);
    }

    /*Проверка является ли пользователь админом*/
    public function is_admin(){
        if (Yii::$app->user->identity->is_admin==1) return true; else return false;
        /*Через тернарный оператор*/
        //  return Yii::$app->user->identity->is_admin==1 ? true : false;
    }
}