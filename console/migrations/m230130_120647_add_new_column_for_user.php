<?php

use yii\db\Migration;

/**
 * Class m230130_120647_add_new_column_for_user
 */
class m230130_120647_add_new_column_for_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'join_date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230130_120647_add_new_column_for_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230130_120647_add_new_column_for_user cannot be reverted.\n";

        return false;
    }
    */
}
