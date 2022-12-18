<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $theatre_id
 * @property string $date_b
 * @property string $time_b
 * @property int $idusr
 *
 * @property Users $idusr0
 * @property Theatres $theatre
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['theatre_id', 'date_b', 'time_b', 'idusr'], 'required'],
            [['theatre_id', 'idusr'], 'integer'],
            [['date_b', 'time_b'], 'string', 'max' => 200],
            [['idusr'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idusr' => 'id']],
            [['theatre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Theatre::className(), 'targetAttribute' => ['theatre_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'theatre_id' => 'Theatre ID',
            'date_b' => 'Date B',
            'time_b' => 'Time B',
            'idusr' => 'Idusr',
        ];
    }

    /**
     * Gets query for [[Idusr0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdusr0()
    {
        return $this->hasOne(User::className(), ['id' => 'idusr']);
    }

    /**
     * Gets query for [[Theatre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTheatre()
    {
        return $this->hasOne(Theatre::className(), ['id' => 'theatre_id']);
    }
}
