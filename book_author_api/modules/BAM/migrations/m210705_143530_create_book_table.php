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

        $connection = Yii::$app->db;
        $dbSchema   = $connection->schema;
        $allTables  = $dbSchema->getTableNames();

        if (Yii::$app->getModule('ADM') && isset($allTables['author']) && !isset($dbSchema->getTable('book')->columns['author'])) {
            $this->dropForeignKey(
                '{{%fk-book-author_id}}',
                '{{%book}}'
            );

            // drops index for column `author_id`
            $this->dropIndex(
                '{{%idx-book-author_id}}',
                '{{%book}}'
            );
        }
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $connection = Yii::$app->db;
        $dbSchema   = $connection->schema;
        $allTables  = $dbSchema->getTableNames();

        if (Yii::$app->getModule('ADM') && isset($allTables['author']) && isset($dbSchema->getTable('book')->columns['author'])) {
            $this->dropForeignKey(
                '{{%fk-book-author_id}}',
                '{{%book}}'
            );

            // drops index for column `author_id`
            $this->dropIndex(
                '{{%idx-book-author_id}}',
                '{{%book}}'
            );
        }

        $this->dropTable('{{%book}}');
    }
}
