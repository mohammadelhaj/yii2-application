<?php

use yii\db\Migration;

/**
 * Class m230130_102450_add_new_column_for_order
 */
class m230130_102450_add_new_column_for_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'date', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230130_102450_add_new_column_for_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230130_102450_add_new_column_for_order cannot be reverted.\n";

        return false;
    }
    */
}
