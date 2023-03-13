<?php

use yii\db\Migration;

/**
 * Class m230125_131632_add_new_table_order
 */
class m230125_131632_add_new_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable(
            'order',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'first_name' => $this->string(255)->notNull(),
                'last_name' => $this->string(255)->notNull(),
                'address' => $this->string(255)->notNull(),
                'total_cost' => $this->float()->notNull(),
                'order_status' => $this->string(20)->notNull(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230125_131632_add_new_table_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230125_131632_add_new_table_order cannot be reverted.\n";

        return false;
    }
    */
}
