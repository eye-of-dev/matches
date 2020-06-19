<?php

use yii\db\Migration;

class m200618_150851_alertTeamsTable extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        //teams table
        $this->createTable('teams', [
            'id'            => 'pk',
            'sport_type_id' => $this->integer()->comment('Вид спорта'),
            'title'         => $this->string()->notNull()->comment('Название'),
            'is_active'     => $this->smallInteger(1)->defaultValue(1)->comment('Статус'),
            'created_at'    => $this->integer()->comment('Дата создания'),
            'updated_at'    => $this->integer()->comment('Дата обновления')
                ], $tableOptions);

        $this->createIndex('sport_type_id_index', 'teams', 'sport_type_id');
        $this->createIndex('title_index', 'teams', 'title');
        $this->createIndex('sport_type_id_title_index', 'teams', ['sport_type_id', 'title'], true);
        $this->createIndex('is_active_index', 'teams', 'is_active');

        $this->addForeignKey('teams_sport_types_fk', 'teams', 'sport_type_id', 'sport_types', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('teams_sport_types_fk', 'teams');
        $this->dropTable('teams');
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
