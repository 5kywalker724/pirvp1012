<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%exhibit}}`.
 */
class m240627_101525_create_exhibit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exhibit}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->unique(),
            'desc' => $this->string()->notNull(),
            'quantity' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%exhibit}}');
    }
}
