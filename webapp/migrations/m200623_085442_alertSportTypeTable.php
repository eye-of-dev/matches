<?php

use yii\db\Migration;

/**
 * Class m200623_085442_alertSportTypeTable
 */
class m200623_085442_alertSportTypeTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('sport_types', 'match_duration', $this->integer()->defaultValue(0)->after('title')->comment('Длительность матча'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('sport_types', 'match_duration');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200623_085442_alertSportTypeTable cannot be reverted.\n";

        return false;
    }
    */
}
