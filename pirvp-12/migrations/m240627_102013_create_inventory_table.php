<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%inventory}}`.
 */
class m240627_102013_create_inventory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%inventory}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'quantity' => $this->integer()->defaultValue(0),
            'inventory_date' => $this->date()->defaultValue(new \yii\db\Expression('NOW()'))
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%inventory}}');
    }
}
