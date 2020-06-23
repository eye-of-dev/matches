<?php

use yii\db\Migration;

/**
 * Class m200621_183439_alertMatchesTable
 */
class m200621_183439_alertMatchesTable extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('matches', 'is_bet');

        $this->addColumn('matches', 'bets', $this->json()->after('start')->comment('Ставки'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('matches', 'is_bet', $this->smallInteger(1)->defaultValue(0)->after('start')->comment('Флаг наличия ставок'));

        $this->createIndex('is_bet_index', 'matches', 'is_bet');

        $this->dropColumn('matches', 'bets');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200621_183439_alertMatchesTable cannot be reverted.\n";

      return false;
      }
     */
}
