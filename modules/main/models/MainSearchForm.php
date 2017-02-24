<?php
/**
 * Created by PhpStorm.
 * User: dzozulya
 * Date: 23.02.17
 * Time: 7:34
 */

namespace app\modules\main\models;


use yii\base\Model;

/**
 * Main search form
 */


class MainSearchForm extends Model
{
    /**
     * @var
     */
    public $destination;
    /**
     * @var
     */
    public $date_from;
    /**
     * @var
     */
    public $date_to;
    /**
     * @var
     */
    public $rooms;
    /**
     * @var
     */
    public $adults;
    /**
     * @var
     */
    public $kids;

    /**
     * @inheritdoc
     * Main form validation rules
     */
    public function rules()
    {
        return [
            ['destination', 'filter', 'filter' => 'trim'],
            [['destination', 'date_from', 'date_to'], 'string'],
            [['rooms', 'adults', 'kids'], 'integer'],
            [['destination', 'date_from', 'date_to', 'rooms', 'adults', 'kids'], 'required']
        ];
    }

    /**
     * @return array
     * Form field labels
     */
    public function attributeLabels()
    {
        return [
            'destination'=>\Yii::t('app', 'Destination'),
            'date_from'=>\Yii::t('app', 'Check In'),
            'date_to'=>\Yii::t('app', 'Check Out'),
            'rooms'=> \Yii::t('app', 'Rooms'),
            'adults'=> \Yii::t('app', 'Adults'),
            'kids'=> \Yii::t('app', 'Kids'),
        ];
    }

    /**
     * Send search form.
     *
     * @return mixed redirect - when ok, false - is failed
     * @throws
     */
    public function send()
    :bool {
        if ($this->validate()) {

           $searchResult = [
                'destination' => $this->destination,
                'date_from' => $this->date_from,
                'date_to' => $this->date_to,
                'rooms' => $this->rooms,
                'adults' => $this->adults,
                'kids' => $this->kids
            ];

            \Yii::$app->response->redirect(['hotels', $searchResult]);

        }

        return false;
    }

}