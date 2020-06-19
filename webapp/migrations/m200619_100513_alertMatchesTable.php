<?php

use yii\db\Migration;

class m200619_100513_alertMatchesTable extends Migration
{

    public function up()
    {
        $this->addColumn('matches', 'tournament_id', $this->integer()->after('sport_type_id')->comment('Турнир'));

        $this->createIndex('tournament_id_index', 'matches', 'tournament_id');

        $this->addForeignKey('matches_tournament_fk', 'matches', 'tournament_id', 'tournaments', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('matches_tournament_fk', 'matches');

        $this->dropColumn('matches', 'tournament_id');
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
