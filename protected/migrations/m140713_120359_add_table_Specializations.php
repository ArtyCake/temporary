<?php

class m140713_120359_add_table_Specializations extends CDbMigration
{
	public function up()
	{
        $this->createTable('specializations',array(
            'id'=>'pk',
            'name' => 'varchar(100) NOT NULL',
            'type' => 'enum("координационный офис", "гипермаркеты" , "логистический центр") NOT NULL',

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
        $this->dropTable('specializations');
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