<?php

use yii\db\Migration;

/**
 * Class m230126_102620_add_new_column_for_items
 */
class m230126_102620_add_new_column_for_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('items', 'order_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230126_102620_add_new_column_for_items cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230126_102620_add_new_column_for_items cannot be reverted.\n";

        return false;
    }
    */
}
