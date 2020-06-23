<?php

use yii\db\Migration;

/**
 * Class m200622_120502_alertMatchesTable
 */
class m200622_120502_alertMatchesTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('matches', 'gg_matches', $this->json()->after('bets')->comment('ID матчей дублей'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('matches', 'gg_matches');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200622_120502_alertMatchesTable cannot be reverted.\n";

        return false;
    }
    */
}
