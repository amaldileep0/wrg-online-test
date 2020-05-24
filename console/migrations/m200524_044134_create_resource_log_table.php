<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_log}}`.
 */
class m200524_044134_create_resource_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource_log}}', [
            'id' => $this->primaryKey(),
            'summary' => $this->string(255),
            'type' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_log}}');
    }
}
