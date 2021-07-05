<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m210705_143434_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
        ]);

        try{
            // creates index for column `author_id` in book table
            $this->createIndex(
                '{{%idx-book-author_id}}',
                '{{%book}}',
                'author_id'
            );

            // add foreign key for table `{{%author}}` in book table
            $this->addForeignKey(
                '{{%fk-book-author_id}}',
                '{{%book}}',
                'author_id',
                '{{%author}}',
                'id',
                'CASCADE'
            );
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%author}}`
        try {
            $this->dropForeignKey(
                '{{%fk-book-author_id}}',
                '{{%book}}'
            );

            // drops index for column `author_id`
            $this->dropIndex(
                '{{%idx-book-author_id}}',
                '{{%book}}'
            );
        } catch (Exception $e) {
            error_log($e->getMessage());
        }

        $this->dropTable('{{%author}}');
    }
}
