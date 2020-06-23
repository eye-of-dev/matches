<?php

use yii\db\Migration;

/**
 * Class m200621_175115_dropTable
 */
class m200621_175115_dropTable extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('bets_matches_fk', 'bets');

        $this->dropTable('bets');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200621_175115_dropTable cannot be reverted.\n";

      return false;
      }
     */
}
