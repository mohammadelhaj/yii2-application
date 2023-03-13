<?php

use yii\db\Migration;

/**
 * Class m230118_080400_category
 */
class m230118_080400_category extends Migration
{
    public function up()
    {
        $this->createTable('category', [
            'idCat' => $this->primaryKey(),
            'categoryName' => $this->string()->notNull(),
            'created_by' => $this->string()->notNull(),
            'date' => $this->string(32)->notNull(),

        ]);
    }

    public function down()
    {
        echo "m230118_080400_category cannot be reverted.\n";

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230118_080400_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230118_080400_category cannot be reverted.\n";

        return false;
    }
    */
}
