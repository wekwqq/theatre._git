<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "theatres".
 *
 * @property int $id
 * @property string $name_t
 * @property string $phone
 * @property string $email
 * @property string $adres
 * @property string|null $photo
 *
 * @property Booking[] $bookings
 */
class Theatre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theatres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_t', 'phone', 'email', 'adres'], 'required'],
            [['name_t', 'phone', 'email', 'adres', 'photo'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_t' => 'Name T',
            'phone' => 'Phone',
            'email' => 'Email',
            'adres' => 'Adres',
            'photo' => 'Photo',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */

}
