<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_service}}`.
 */
class m240622_113000_create_user_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_service}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-user_service-user_id',
            'user_service',
            'user_id'
        );
        $this->addForeignKey(
            'fk-user_service-user_id',
            'user_service',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-user_service-service_id',
            'user_service',
            'service_id'
        );
        $this->addForeignKey(
            'fk-user_service-service_id',
            'user_service',
            'service_id',
            'service',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_service}}');
    }
}
