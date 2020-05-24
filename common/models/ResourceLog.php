<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "resource_log".
 *
 * @property int $id
 * @property string|null $summary
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 */
class ResourceLog extends \yii\db\ActiveRecord
{   

    const ACTION_UPLOAD = 1;
    const ACTION_DELETE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resource_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['summary'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summary' => 'Summary',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * @param $event
     */
    public static function fileUpload($event)
    {   
        $model = new ResourceLog();
        $model->type = self::ACTION_UPLOAD;
        $model->summary = 'New file uploaded with name'.' - '.$event->sender->file_path;
        $model->save();
    }

    /**
     * @param $event
     */
    public static function fileDelete($event)
    {    
        $model = new ResourceLog();
        $model->type = self::ACTION_DELETE;
        $model->summary = 'A file with name'.' - '.$event->sender->file_path .' '.'was removed';
        $model->save();
    }


}
