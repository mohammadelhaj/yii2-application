<?php

use yii\db\Migration;

/**
 * Class m230125_085312_add_column_to_shopping_cart
 */
class m230125_085312_add_column_to_shopping_cart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shopping-cart', 'price', $this->double());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230125_085312_add_column_to_shopping_cart cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230125_085312_add_column_to_shopping_cart cannot be reverted.\n";

        return false;
    }
    */
}
