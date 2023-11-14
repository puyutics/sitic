<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class Dinarp extends Model
{
    public $dni;
    public $api_url;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni', 'api_url'], 'safe'],
            [['dni', 'api_url'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni' => 'Cédula/Pasaporte',
            'api_url' => 'API URL',
        ];
    }

    public function biometrico($api_url, $api_token)
    {
        $headers = array(
            'Authorization: Bearer ' . $api_token,
            'Content-Type: application/json'
        );

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $api_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($handle);
        curl_close($handle);

        return $response;
    }
}