<?php

use yii\db\Migration;

/**
 * Class m230118_082155_product
 */
class m230118_082155_product extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'idProd' => $this->primaryKey(),
            'productName' => $this->string()->notNull(),
            'price' => $this->string()->notNull(),
            'category' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'img1' => $this->string()->notNull(),
            'img2' => $this->string()->notNull(),
            'img3' => $this->string()->notNull(),
            'created_by' => $this->string()->notNull(),
            'date' => $this->string(32)->notNull(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m230118_082155_product cannot be reverted.\n";

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
        echo "m230118_082155_product cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230118_082155_product cannot be reverted.\n";

        return false;
    }
    */
}
