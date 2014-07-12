<?php

class m140712_075450_add_table_structure extends CDbMigration
{
	public function up()
	{
		$this->createTable('structure',array(
			'id'=>'pk',
			'name' => 'varchar(100) NOT NULL',
			'parent_id' => 'int(11) DEFAULT 0',
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
		$this->dropTable('structure');
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
