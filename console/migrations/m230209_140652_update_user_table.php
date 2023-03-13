<?php

use yii\db\Migration;

/**
 * Class m230209_140652_update_user_table
 */
class m230209_140652_update_user_table extends Migration
{
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
        echo "m230209_140652_update_user_table cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->addColumn('{{%user}}', 'access_token', $this->string()->unique()->after('auth_key'));
    }
    
    public function down()
    {
        $this->dropColumn('{{%user}}', 'access_token');
    }
}
