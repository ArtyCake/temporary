<?php

class m140712_071002_add_teble_users extends CDbMigration
{
	public function up()
	{
		$this->createTable('users',
		array(
			'id'=>'pk',
			'number' => "varchar(10) UNIQUE NOT NULL",
			'surname' => 'varchar(50) NOT NULL',
			'name' => 'varchar(50) NOT NULL',
			'patronymic' => 'varchar(50)',
			'structure_point' => 'int(11) NOT NULL',
			'role' => 'tinyint(1) COMMENT "0:global admin, 1:admin, 2:moderator, 3:consult, 4:employer, 5:trainee"',
			'password' => 'varchar(60) NOT NULL',
			'create_user_id' => 'int(11)',
            'create_date' => 'datetime',
            'update_user_id' => 'int(11)',
            'update_date' => 'datetime',
            'deleted' => 'int(1) DEFAULT 0',
            'deleted_denied' => 'int(1) DEFAULT 0',
		));
	}

	public function down()
	{
		$this->dropTable('users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
