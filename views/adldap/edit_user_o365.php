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
//https://learn.microsoft.com/en-us/graph/api/user-get?view=graph-rest-1.0&tabs=php

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

    //Buscar Teams
    $teams = $client->getUsers()
        ->getById($model->mail)
        ->getJoinedTeams()
        ->get()
        ->executeQuery()
        ->toJson();

    $count = count($teams);
    $teamsProvider = new ArrayDataProvider([
        'allModels' => $teams,
        'pagination' => ['pageSize' => $count,],
        'sort' => ['attributes' => ['DisplayName' => SORT_ASC,]],
    ]);

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
            'UserPrincipalName',
            'DisplayName',
            'Surname',
            'GivenName',
            'Mail',
            'MobilePhone',
            [
                'attribute' => 'BusinessPhones',
                'value' => function($model) {
                    $echo = '';
                    $BusinessPhones = $model['BusinessPhones'];
                    if (count($BusinessPhones) > 0) {
                        foreach ($BusinessPhones as $BusinessPhone) {
                            $echo = $echo.
                                $BusinessPhone.
                                "<br>";
                        }
                        return $echo;
                    } else {
                        return '-';
                    }

                },
                'format' => 'html'
            ],
            'Department',
            'JobTitle',
            //'PreferredLanguage',
            [
                'attribute' => 'AssignedLicenses',
                'value' => function($model) {
                    $echo = ''; $i=0;
                    $AssignedLicenses = $model['AssignedLicenses'];
                    foreach ($AssignedLicenses as $AssignedLicense) {
                        $i = $i+1;
                        $echo = $echo.$i.'. ';
                        if ($AssignedLicense['skuId'] == '4b590615-0888-425a-a965-b3bf7789848d') $echo = $echo.'Microsoft 365 Educación A3 para profesores';
                        elseif ($AssignedLicense['skuId'] == 'de5f128b-46d7-4cfc-b915-a89ba060ea56') $echo = $echo.'Power BI Pro para Profesores';
                        elseif ($AssignedLicense['skuId'] == 'c32f9321-a627-406d-a114-1f9c81aaafac') $echo = $echo.'Aplicaciones de Microsoft 365 para estudiantes';
                        elseif ($AssignedLicense['skuId'] == '18250162-5d87-4436-a834-d795c15c80f3') $echo = $echo.'Beneficios de uso para estudiantes de Microsoft 365 A3';
                        elseif ($AssignedLicense['skuId'] == 'a403ebcc-fae0-4ca2-8c8c-7a907fd6c235') $echo = $echo.'Power BI (gratis)';
                        elseif ($AssignedLicense['skuId'] == '314c4481-f395-4525-be8b-2ec4bb1e9d91') $echo = $echo.'Office 365 Educación para estudiantes';
                        elseif ($AssignedLicense['skuId'] == 'f30db892-07e9-47e9-837c-80727f46fd3d') $echo = $echo.'Microsoft Flow Gratis';
                        else $echo = $echo.$AssignedLicense['skuId'];
                        $echo = $echo."<br>";
                    }
                    return $echo;
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'CreatedDateTime',
                'value' => function($model) {
                    $CreatedDateTime = strtotime($model['CreatedDateTime']);
                    return date('Y-m-d  H:i:s', $CreatedDateTime);
                }
            ],
            [
                'attribute' => 'LastPasswordChangeDateTime',
                'value' => function($model) {
                    $LastPasswordChangeDateTime = strtotime($model['LastPasswordChangeDateTime']);
                    return date('Y-m-d  H:i:s', $LastPasswordChangeDateTime);
                }
            ],
            [
                'attribute' => 'OnPremisesLastSyncDateTime',
                'value' => function($model) {
                    $OnPremisesLastSyncDateTime = strtotime($model['OnPremisesLastSyncDateTime']);
                    return date('Y-m-d  H:i:s', $OnPremisesLastSyncDateTime);
                }
            ],
            [
                'attribute' => 'CreationType',
                'value' => function($model) {
                    $CreationType = $model['CreationType'];
                    if ($CreationType == NULL) {
                        return 'Regular School or Work account';
                    } else {
                        return $CreationType;
                    }
                },
                'format' => 'html'
            ],
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

<?php if (isset($teams)) { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">Microsoft Teams</h3>
        <!--<h4><code>Información de prueba - Módulo en desarrollo</code></h4>-->
    </div>

    <div align="left">
        <?php /*$i=0;
        foreach ($teams as $team) {
            //if (str_contains($team['DisplayName'], Yii::$app->params['course_code'])) {
                $i=$i+1;
                echo $i.'. ';
                //echo $team['Id'].' >> ';
                echo $team['DisplayName'];
                //echo json_encode($team);
                echo "<br>";
                break;
            //}
        }*/ ?>

        <?= GridView::widget([
            'dataProvider' => $teamsProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'Id',
                'DisplayName',
                //'Description',
                //'CreatedDateTime',
                //'InternalId',
                //'Classification',
                //'Specialization',
                //'Visibility',
                //'WebUrl',
                //'IsArchived',
                //'TenantId',
                //'IsMembershipLimitedToOwners',
                //'MemberSettings',
                //'GuestSettings',
                //'MessagingSettings',
                //'FunSettings',
                //'DiscoverySettings',
                //'Summary',

                //['class' => 'yii\grid\ActionColumn'],
            ],
            'containerOptions' => ['style'=>'overflow: auto'],
            'pjax' => false,
            'bordered' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
            'hover' => true,
            'panel' => [
                'type' => GridView::TYPE_PRIMARY
            ],
        ]); ?>
    </div>
<?php } ?>


