<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%author}}`
 */
class m210705_143530_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
            'author_id' => $this->integer(),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-book-author_id}}',
            '{{%book}}',
            'author_id'
        );

        // add foreign key for table `{{%author}}`
        $this->addForeignKey(
            '{{%fk-book-author_id}}',
            '{{%book}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%author}}`
        $this->dropForeignKey(
            '{{%fk-book-author_id}}',
            '{{%book}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-book-author_id}}',
            '{{%book}}'
        );

        $this->dropTable('{{%book}}');
    }
}
