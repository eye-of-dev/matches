<?php

use yii\db\Migration;

/**
 * Class m200622_123316_alertAllTables
 */
class m200622_123316_alertAllTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('matches', 'created_at');
        $this->dropColumn('matches', 'updated_at');
        
        $this->dropColumn('sport_types', 'created_at');
        $this->dropColumn('sport_types', 'updated_at');
        
        $this->dropColumn('teams', 'created_at');
        $this->dropColumn('teams', 'updated_at');
        
        $this->dropColumn('tournaments', 'created_at');
        $this->dropColumn('tournaments', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200622_123316_alertAllTables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200622_123316_alertAllTables cannot be reverted.\n";

        return false;
    }
    */
}
