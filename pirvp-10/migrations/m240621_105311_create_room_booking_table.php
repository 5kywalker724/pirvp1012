<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room_booking}}`.
 */
class m240621_105311_create_room_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room_booking}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'room_id' => $this->integer()->notNull(),
            'formalization' => $this->string()->defaultValue('Нет'),
        ]);

        $this->createIndex(
            'idx-room_booking-user_id',
            'room_booking',
            'user_id'
        );
        $this->addForeignKey(
            'fk-room_booking-user_id',
            'room_booking',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-room_booking-room_id',
            'room_booking',
            'room_id'
        );
        $this->addForeignKey(
            'fk-room_booking-room_id',
            'room_booking',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%room_booking}}');
    }
}
