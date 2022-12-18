<?php
namespace app\controllers;
use app\models\Chart;
use app\models\LoginForm;
use app\models\Product;
use app\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class UserController extends FunctionController
{
    public $modelClass = 'app\models\User';
    public function behaviors()
    {
        /*
         * Указание на аутентификации по токену
         */
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
            'only'=>['account'] //Перечислите для контроллера методы, требующие аутентификации
            //здесь метод actionAccount()
        ];
        return $behaviors;
    }

    /*Регистрация пользователя*/
    public function actionCreate(){
        $request=Yii::$app->request->post(); //получение данных из post запроса
        $users=new User($request); // Создание модели на основе присланных данных
        if (!$users->validate()) return $this->validation($users); //Валидация модели
        $users->passwd=Yii::$app->getSecurity()->generatePasswordHash($users->passwd); //хэширование пароля
        $users->save();//Сохранение модели в БД
        return $this->send(201, ['content'=>['code'=>201, 'message'=>'Вы зарегистрировались']]);//Отправка сообщения пользователю
    }

    public function actionLogin()
    {
        $request = Yii::$app->request->post();
        $loginForm=new LoginForm($request);
        if (!$loginForm->validate()) return $this->validation($loginForm);
        $users=User::find()->where(['login'=>$request['login']])->one();
        if (isset($users) && Yii::$app->getSecurity()->validatePassword($request['passwd'], $users->passwd)){
            $users->token=Yii::$app->getSecurity()->generateRandomString();
            $users->save(false);
            return $this->send(200, ['content'=>['token'=>$users->token]]);
        }
        return $this->send(401, ['content'=>['code'=>401, 'message'=>'Неверный логин или пароль!']]);
    }

    public function actionAccount()
    {
        $users=Yii::$app->user->identity;
        return $this->send(200,$users);
    }

    public function actionSearch()
    {
        $users=User::find()->all();
        return $this->send(200,['data'=>['orders'=>$users]]);
    }

    public function  actionPhone($id)
    {    $request=Yii::$app->request->getBodyParams();
        $users=User::findOne($id);
        if (!$users) return $this->send(404,  ['content'=>['code'=>404, 'message'=>'Пользователь не найден']]);
        $users=Yii::$app->user->identity; // Получить идентифицированного пользователя
        if (isset($request['phone'])) $users->phone = $request['phone'];

        if (!$users->validate()) return $this->validation($users);
        $users->save();
        return $this->send(200, ['content'=>['code'=>200, 'message'=>'Данные обновлены']]);

    }


}