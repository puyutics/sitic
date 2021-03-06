<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysEmail */
/* @var $type */
/* @var $head */
/* @var $footer */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Servicio de Email', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sys-email-view">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php if ($type == 'adldapgroup') { ?>

        <?php if (Yii::$app->session->get('authtype') == 'adldap') {
            $modelAdldapGroup = new \app\models\AdldapGroupForm();

            // find group
            $groupObject = \Yii::$app->ad->search()->findBy('cn', $model->to);

            if ($groupObject != null && $groupObject->exists) {
                $modelAdldapGroup->name = $groupObject->getName();
                $modelAdldapGroup->dn = $groupObject->getDN();
                $modelAdldapGroup->groupType = $groupObject->getGroupType();
                $modelAdldapGroup->members = $groupObject->getMembers();
            }

            //enviarEmail
            foreach($modelAdldapGroup->members as $member) {
                    Yii::$app->mailerComunicados->compose()
                        ->setTo($member->getEmail())
                        ->setFrom($model->from)
                        ->setReplyTo($model->replyto)
                        //->setBcc($model->from)
                        ->setSubject($model->subject)
                        ->setHtmlBody($head . $model->body . $footer)
                        //->attach('uploads/tabintformulario/contrato/' . $filename)
                        ->send();

                    echo('Correo enviado a: ' . $member->getEmail());

            }

            $model->status = 2;
            if ($model->save()) {
                //return $this->redirect(['view', 'id' => base64_encode($model->id)]);
            }
        } ?>


    <?php } else if ($type == 'emailuser') { ?>

        <?php Yii::$app->mailerComunicados->compose()
            //->setTo($model->to)
            ->setFrom($model->from)
            ->setReplyTo($model->replyto)
            ->setBcc([$model->to])
            ->setSubject($model->subject)
            ->setHtmlBody($head . $model->body . $footer)
            //->attach('uploads/tabintformulario/contrato/' . $filename)
            ->send();

        $model->status = 2;
        if ($model->save()) {
            //return $this->redirect(['view', 'id' => base64_encode($model->id)]);
        } ?>

    <?php } else if ($type == 'o365list') { ?>

        <?php $destinatarios = json_decode($model->to);

        //enviarEmail
        foreach($destinatarios as $destinatario) {
            Yii::$app->mailerComunicados->compose()
                ->setTo($model->replyto)
                ->setFrom($model->from)
                ->setReplyTo($model->replyto)
                ->setBcc($destinatario)
                ->setSubject($model->subject)
                ->setHtmlBody($head . $model->body . $footer)
                //->attach('uploads/tabintformulario/contrato/' . $filename)
                ->send();
        }

        ?>
        <div class="alert alert-success" align="center">
            <h4 align="center">Su comunicado ha sido enviado correctamente.</h4>
        </div>
        <?php
        $model->status = 2;
        if ($model->save()) {
            //return $this->redirect(['view', 'id' => base64_encode($model->id)]);
        } ?>

    <?php } ?>

</div>
