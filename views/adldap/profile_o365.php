<?php

use yii\widgets\DetailView;
use Office365\GraphServiceClient;
use Office365\Runtime\Auth\AADTokenProvider;
use Office365\Runtime\Auth\ClientCredential;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $model */

//https://github.com/vgrem/phpSPO
//https://learn.microsoft.com/es-es/graph/api/overview?view=graph-rest-1.0

?>

<?php function acquireToken()
{
    $tenant = Yii::$app->params['o365_api_tenant'];
    $resource = "https://graph.microsoft.com";
    $provider = new AADTokenProvider($tenant);
    $clientId = Yii::$app->params['o365_api_client_id'];
    $clientSecret = Yii::$app->params['o365_api_client_secret'];
    $clientCredential = new ClientCredential($clientId, $clientSecret);
    $scope = "/.default";
    return $provider->acquireTokenForClientCredential(
        $resource,
        $clientCredential,
        [$scope]
    );
} ?>

<?php try {
    $client = new GraphServiceClient("acquireToken");
    //Buscar usuario
    $user = $client->getUsers()
        ->getById($model->mail)
        ->select([
            'Id',
            'MySite',
            'UserPrincipalName',
            'DisplayName',
            'Surname',
            'GivenName',
            'Mail',
            'MobilePhone',
            'Department',
            'JobTitle',
            'PreferredLanguage',
            'BusinessPhones',
            'AccountEnabled',
            'AssignedLicenses',
            'CreatedDateTime',
            'CreationType',
            'LastPasswordChangeDateTime',
            'OnPremisesLastSyncDateTime',
        ])
        ->get()
        ->executeQuery()
        ->toJson();

    //Cuota OneDrive
    $drive = $client->getUsers()
        ->getById($model->mail)
        ->getDrive()
        ->get()
        ->executeQuery()
        ->toJson();
    $drive_quota = $drive['Quota'];

} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>

<?php if (isset($user)) { ?>

    <div class="alert alert-info" align="center">
        <h3 align="center">Cuenta - Microsoft 365</h3>
    </div>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            [
                'attribute' => 'Id',
                'value' => function($model) {
                    return '<code>'.$model['Id'].'</code>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'MySite',
                'value' => function($model) {
                    return '<a href="'.$model['MySite'].'" target="_blank">'.$model['MySite'].'</a>';
                },
                'format' => 'raw'
            ],
            'DisplayName',
            'Mail',
            [
                'attribute' => 'AccountEnabled',
                'value' => function($model) {
                    $echo = '';
                    $AccountEnabled = $model['AccountEnabled'];
                    if ($AccountEnabled == 1) {
                        return '<p style="color:darkgreen">Cuenta activa '. Icon::show('check').'</p>';
                    } elseif ($AccountEnabled == 0) {
                        return '<p style="color:darkred">Cuenta inactiva '. Icon::show('trash').'</p>';
                    } else {
                        return $AccountEnabled;
                    }
                },
                'format' => 'html'
            ],
        ],
    ]); ?>
<?php } ?>

<?php if (isset($drive_quota)) { ?>

    <div class="alert alert-info" align="center">
        <h3 align="center">Almacenamiento - OneDrive</h3>
    </div>

    <?= DetailView::widget([
        'model' => $drive_quota,
        'attributes' => [
            [
                'label' => 'Estado',
                'attribute' => 'State',
                'value' => function($model) {
                    if ($model->State == 'normal') {
                        return '<p style="color:darkgreen">'.$model->State.' '.Icon::show('check').'</p>';
                    }
                    elseif ($model->State == 'exceeded') {
                        return '<p style="color:darkred">'.$model->State.' '.Icon::show('trash').'</p>';
                    }
                    return '<code>'.$model->State.'</code>';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'Used',
                'label' => 'Cuota',
                'value' => function ($model) {
                    $percent = round(($model->Used / $model->Total) * 100,2);
                    // striped animated
                    if ($percent >= 0 and $percent < 80) {
                        return \yii\bootstrap\Progress::widget(
                            [
                                'percent' => $percent,
                                'label' => $percent.'%',
                                'options' => ['class' => 'progress-success active progress-striped'],
                            ]
                        );
                    }
                    if ($percent >= 80 and $percent < 90) {
                        return \yii\bootstrap\Progress::widget(
                            [
                                'percent' => $percent,
                                'label' => $percent.'%',
                                'options' => ['class' => 'progress-warning active progress-striped'],
                            ]
                        );
                    }
                    if ($percent >= 90 and $percent < 100) {
                        return \yii\bootstrap\Progress::widget(
                            [
                                'percent' => $percent,
                                'label' => $percent.'%',
                                'options' => ['class' => 'progress-danger active progress-striped'],
                            ]
                        );
                    }
                    if ($percent >= 100) {
                        return \yii\bootstrap\Progress::widget(
                            [
                                'percent' => 100,
                                'label' => $percent.'%',
                                'options' => ['class' => 'progress-danger active progress-striped'],
                            ]
                        );
                    }
                },
                'format' => 'html',
            ],
            [
                'label' => 'Total',
                'attribute' => 'Total',
                'value' => function($model) {
                    return human_filesize($model->Total);
                },
            ],
            [
                'label' => 'Usado',
                'attribute' => 'Used',
                'value' => function($model) {
                    return human_filesize($model->Used);
                },
            ],
            [
                'label' => 'Eliminado',
                'attribute' => 'Deleted',
                'value' => function($model) {
                    return human_filesize($model->Deleted);
                },
            ],
            [
                'label' => 'Disponible',
                'attribute' => 'Remaining',
                'value' => function($model) {
                    return human_filesize($model->Remaining);
                },
            ],
        ],
    ]); ?>
<?php } ?>


<?php function human_filesize($size, $precision = 2) {
    for($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {}
    return round($size, $precision).[' B',' kB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB'][$i];
} ?>


