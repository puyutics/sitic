<?php

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => Yii::$app->user->identity->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');

if (isset($_GET['search'])
    and (Yii::$app->session->get('authtype') == 'adldap')) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);

    $this->render('edit_user', [
        'model' => $model,
        ]);
}

elseif (isset(Yii::$app->user->identity->username)
    and (Yii::$app->session->get('authtype') == 'adldap')) {

    $this->render('edit_profile', [
        'model' => $model,
    ]);
}



