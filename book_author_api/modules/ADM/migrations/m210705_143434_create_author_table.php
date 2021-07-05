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

        $connection = Yii::$app->db;
        $dbSchema   = $connection->schema;
        $allTables  = $dbSchema->getTableNames();

        if (Yii::$app->getModule('BAM') && isset($allTables['book']) && !isset($dbSchema->getTable('book')->columns['author'])) {
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

        if (Yii::$app->getModule('BAM') && isset($allTables['book']) && isset($dbSchema->getTable('book')->columns['author'])) {
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

        $this->dropTable('{{%author}}');
    }
}
