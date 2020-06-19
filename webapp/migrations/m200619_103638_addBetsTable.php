<?php

use yii\db\Migration;

class m200619_103638_addBetsTable extends Migration
{

    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        //bets table
        $this->createTable('bets', [
            'id'         => 'pk',
            'match_id'   => $this->integer()->comment('Матч'),
            'bet'        => $this->json()->comment('Ставка'),
            'created_at' => $this->integer()->comment('Дата создания'),
            'updated_at' => $this->integer()->comment('Дата обновления')
                ], $tableOptions);

        $this->createIndex('match_id_index', 'bets', 'match_id');
        $this->addForeignKey('bets_matches_fk', 'bets', 'match_id', 'matches', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('bets_matches_fk', 'bets');

        $this->dropTable('bets');
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
