<?php

use yii\db\Migration;

/**
 * Class m201228_141036_add_column_to_table_recipe_is_homechef
 */
class m201228_141036_add_column_to_table_recipe_is_homechef extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('ri_recipe', 'is_homechef', $this->boolean()->notNull()->defaultValue(true));
        $this->addColumn('ri_recipe', 'is_easy', $this->boolean()->notNull()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201228_141036_add_column_to_table_recipe_is_homechef cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_141036_add_column_to_table_recipe_is_homechef cannot be reverted.\n";

        return false;
    }
    */
}
