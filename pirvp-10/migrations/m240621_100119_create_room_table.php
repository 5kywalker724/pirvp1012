<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m240621_100119_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'desc' => $this->string(255)->notNull(),
            'seats' => $this->integer()->notNull()->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%room}}');
    }
}
