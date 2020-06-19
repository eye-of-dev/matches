<?php

use yii\db\Migration;

class m160505_100354_initMigration extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        //Users table
        $this->createTable('users', [
            'id'         => 'pk',
            'username'   => $this->string()->notNull(),
            'password'   => $this->string()->notNull(),
            'name'       => $this->string()->notNull(),
            'email'      => $this->string()->notNull(),
            'role'       => $this->string()->notNull()->defaultValue('user'),
            'is_active'  => $this->smallInteger(1)->defaultValue(1),
            'created_at' => $this->integer()->comment('Дата создания'),
            'updated_at' => $this->integer()->comment('Дата обновления')
                ], $tableOptions);

        $this->createIndex('username_index', 'users', 'username');
        $this->createIndex('is_active_index', 'users', 'is_active');

        echo 'DEFAULT USERNAME: admin';
        echo 'DEFAULT PASSWORD: 123456';

        $this->insert('users', [
            'username'   => 'admin',
            'password'   => '$2y$13$.TW4UJ.e8cTdTusrMH4hd.HAtuTxAxfd04njOsemp5JY5ZG/IvhXm',
            'name'       => 'admin',
            'email'      => 'admin@sitename.ru',
            'role'       => 'admin',
            'created_at' => time(),
            'updated_at' => time()
        ]);

        //Config table
        $this->createTable('config', [
            'id'    => 'pk',
            'param' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'title' => $this->string()->notNull()
                ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('config');
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
