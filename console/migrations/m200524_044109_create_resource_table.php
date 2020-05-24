<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource}}`.
 */
class m200524_044109_create_resource_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resource}}', [
            'id' => $this->primaryKey(),
            'file_path' => $this->string(255)->notNull(),
            'file_type' => $this->string(150)->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource}}');
    }
}
