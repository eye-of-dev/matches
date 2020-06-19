<?php

use yii\db\Migration;

class m200619_093518_addtournamentsTable extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        //tournaments table
        $this->createTable('tournaments', [
            'id'         => 'pk',
            'title'      => $this->string()->notNull()->comment('Название'),
            'is_active'  => $this->smallInteger(1)->defaultValue(1)->comment('Статус'),
            'created_at' => $this->integer()->comment('Дата создания'),
            'updated_at' => $this->integer()->comment('Дата обновления')
                ], $tableOptions);

        $this->createIndex('title_index', 'tournaments', 'title', true);
        $this->createIndex('is_active_index', 'tournaments', 'is_active');
    }

    public function down()
    {
        $this->dropTable('tournaments');
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
