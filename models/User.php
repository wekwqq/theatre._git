<?php

namespace app\models;

use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string $bday
 * @property string $phone
 * @property string $email
 * @property string $login
 * @property string $passwd
 * @property string|null $token
 *
 * @property Booking[] $bookings
 */

class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'bday', 'phone', 'email', 'login', 'passwd'], 'required'],
            [['fname', 'lname', 'bday', 'phone', 'email', 'login', 'passwd'], 'string', 'max' => 200],
            [['token'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'bday' => 'Bday',
            'phone' => 'Phone',
            'email' => 'Email',
            'login' => 'Login',
            'passwd' => 'Passwd',
            'token' => 'Token',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['idusr' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return;
    }

    public function validateAuthKey($authKey)
    {
        return;
    }

    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    public function validatePassword($passwd)
    {
        return Yii::$app->security->validatePassword($passwd, $this->passwd);
    }

}
