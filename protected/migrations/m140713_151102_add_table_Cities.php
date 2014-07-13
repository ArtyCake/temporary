<?php

class m140713_151102_add_table_Cities extends CDbMigration
{
	public function up()
	{
        $this->createTable('cities',array(
            'id'=>'pk',
            'name' => 'varchar(100) NOT NULL',
            'region_id' => 'int(11) NOT NULL',

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
        $this->dropTable('cities');
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