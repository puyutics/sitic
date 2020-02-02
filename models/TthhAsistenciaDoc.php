<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tthh_asistencia_doc".
 *
 * @property int $id_asistencia
 * @property string $idx_servidor
 * @property string $idx_tipoasistencia
 * @property string $idx_motivo
 * @property string $idx_tipodocumento
 * @property string $numero_documento
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property int $dias
 * @property int $horas
 * @property int $minutos
 * @property string $descripcion
 * @property int $status_envio
 * @property string $fecha_envio
 * @property int $status_revision
 * @property string $fecha_revision
 * @property int $status_aprobacion
 * @property string $fecha_aprobacion
 * @property string $ip_registrado
 * @property string $idx_usuario Usuario que registra la asistencia
 * @property string $hora_inicial
 * @property string $hora_final
 * @property int $vacaciones_st
 */
class TthhAsistenciaDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tthh_asistencia_doc';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sisges');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_inicio', 'fecha_fin', 'fecha_envio', 'fecha_revision', 'fecha_aprobacion', 'hora_inicial', 'hora_final'], 'safe'],
            [['dias', 'horas', 'minutos', 'status_envio', 'status_revision', 'status_aprobacion', 'vacaciones_st'], 'integer'],
            [['descripcion'], 'string'],
            [['idx_servidor'], 'string', 'max' => 20],
            [['idx_tipoasistencia', 'idx_motivo', 'idx_tipodocumento'], 'string', 'max' => 2],
            [['numero_documento'], 'string', 'max' => 25],
            [['ip_registrado'], 'string', 'max' => 40],
            [['idx_usuario'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asistencia' => 'Id Asistencia',
            'idx_servidor' => 'Idx Servidor',
            'idx_tipoasistencia' => 'Idx Tipoasistencia',
            'idx_motivo' => 'Idx Motivo',
            'idx_tipodocumento' => 'Idx Tipodocumento',
            'numero_documento' => 'Numero Documento',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'dias' => 'Dias',
            'horas' => 'Horas',
            'minutos' => 'Minutos',
            'descripcion' => 'Descripcion',
            'status_envio' => 'Status Envio',
            'fecha_envio' => 'Fecha Envio',
            'status_revision' => 'Status Revision',
            'fecha_revision' => 'Fecha Revision',
            'status_aprobacion' => 'Status Aprobacion',
            'fecha_aprobacion' => 'Fecha Aprobacion',
            'ip_registrado' => 'Ip Registrado',
            'idx_usuario' => 'Idx Usuario',
            'hora_inicial' => 'Hora Inicial',
            'hora_final' => 'Hora Final',
            'vacaciones_st' => 'Vacaciones St',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXMotivo()
    {
        return $this->hasOne(TthhMotivo::className(), ['id_m' => 'idx_motivo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXTipoasistencia()
    {
        return $this->hasOne(TthhTipoAsistencia::className(), ['id_ta' => 'idx_tipoasistencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXTipodocumento()
    {
        return $this->hasOne(TthhTipoDocumento::className(), ['id_td' => 'idx_tipodocumento']);
    }

}
