<?php

use yii\db\Migration;

class m200618_161616_addMatchesTable extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        //matches table
        $this->createTable('matches', [
            'id'                => 'pk',
            'sport_type_id'     => $this->integer()->comment('Вид спорта'),
            'parent_match_id'   => $this->string(32)->comment('Родительский матч'),
            'external_match_id' => $this->string(32)->comment('Внешний ID матча'),
            'team_home_id'      => $this->integer()->comment('Хозяева'),
            'team_guest_id'     => $this->integer()->comment('Гости'),
            'start'             => $this->integer()->comment('Дата начала матча'),
            'is_bet'            => $this->smallInteger(1)->defaultValue(0)->comment('Флаг наличия ставок'),
            'created_at'        => $this->integer()->comment('Дата создания'),
            'updated_at'        => $this->integer()->comment('Дата обновления')
                ], $tableOptions);


        $this->createIndex('sport_type_id_index', 'matches', 'sport_type_id');
        $this->createIndex('parent_match_id_index', 'matches', 'parent_match_id');
        $this->createIndex('external_match_id_index', 'matches', 'external_match_id', true);
        $this->createIndex('team_home_id_index', 'matches', 'team_home_id');
        $this->createIndex('team_guest_id_index', 'matches', 'team_guest_id');
        $this->createIndex('is_bet_index', 'matches', 'is_bet');

        $this->addForeignKey('matches_sport_types_fk', 'matches', 'sport_type_id', 'sport_types', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('matches_team_home_fk', 'matches', 'team_home_id', 'teams', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('matches_team_guest_fk', 'matches', 'team_guest_id', 'teams', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('matches_sport_types_fk', 'matches');
        $this->dropForeignKey('matches_team_home_fk', 'matches');
        $this->dropForeignKey('matches_team_guest_fk', 'matches');
        $this->dropTable('matches');
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
