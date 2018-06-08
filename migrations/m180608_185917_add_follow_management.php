<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_185917_add_follow_management
 */
class m180608_185917_add_follow_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/follow/admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/follow/admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'follow_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'follow_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'follow_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'follow_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'follow_management', 'child' => '/follow/admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'follow_management',
					'child'		=> '/follow/admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'follow_manager', 'child' => 'follow_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'follow_manager',
					'child'		=> 'follow_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'follow_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'follow_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
