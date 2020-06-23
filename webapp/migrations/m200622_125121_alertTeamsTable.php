<?php

use yii\db\Migration;

/**
 * Class m200622_125121_alertTeamsTable
 */
class m200622_125121_alertTeamsTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('teams', 'external_team_id', $this->string(32)->after('sport_type_id')->comment('Внешний ID команды'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('teams', 'external_team_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200622_125121_alertTeamsTable cannot be reverted.\n";

        return false;
    }
    */
}
