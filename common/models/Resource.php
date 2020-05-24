<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use common\models\ResourceLog;

/**
 * This is the model class for table "resource".
 *
 * @property int $id
 * @property string $file_path
 * @property string $file_type
 * @property int $updated_at
 * @property int $created_at
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource';
    }

    public function init()
    {
        $this->on(ResourceLog::ACTION_UPLOAD, ['common\models\ResourceLog', 'fileUpload']);
        $this->on(ResourceLog::ACTION_DELETE, ['common\models\ResourceLog', 'fileDelete']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['updated_at', 'created_at'], 'safe'],
            [['updated_at', 'created_at'], 'integer'],
            [['file_type'],'required'],
            [['file_path'], 'required'],
            [['file_path'], 'file'],
            [['file_type'], 'string', 'max' => 150],
            [['file_path'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'txt,doc,docx,pdf,png,jpeg,jpg,gif', 
                'maxSize' => \Yii::$app->params['fileUploadSize']['imageFileSize'],
                'tooBig' => \Yii::$app->params['fileUploadSize']['imageSizeMsg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_path' => 'File',
            'file_type' => 'File Type',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public function logUpload()
    {
        $this->trigger(ResourceLog::ACTION_UPLOAD);
    }

    public function logDelete()
    {
        $this->trigger(ResourceLog::ACTION_DELETE);
    }
}
