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

        $this->insert('{{%auth_item}}', [
            'name' => '/follow/admin/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'follow_management',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'follow_management',
            'child' => '/follow/admin/*',
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'follow_manager',
            'type' => 1,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'follow_manager',
            'child' => 'follow_management',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'follow_manager',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'follow_manager',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'follow_manager',
            'child' => 'follow_management',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'follow_manager',
            'type' => 1,
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'follow_management',
            'child' => '/follow/admin/*',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'follow_management',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/follow/admin/*',
            'type' => 2,
        ]);
        $this->dropTable('{{%eg_follow}}');
    }
}
