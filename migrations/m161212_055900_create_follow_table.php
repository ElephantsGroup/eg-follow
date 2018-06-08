<?php

use yii\db\Migration;

/**
 * Handles the creation of table `follow`.
 */
class m161212_055900_create_follow_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%eg_follow}}', [
            'id' => $this->primaryKey(),
            'ip' => $this->string(32),
            'item_id' => $this->integer(11),
            'service_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'follow' => $this->smallInteger()->notNull()->defaultValue(0),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%eg_follow}}');
    }
}
