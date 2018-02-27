<?php

use yii\db\Migration;

/**
 * Handles the creation of table `langs`.
 * Список языков в системе
 */
class m180216_082306_create_langs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%langs}}', [
            '[[lang_id]]' => $this->primaryKey()->comment('Идентификатор языка'),
            '[[name]]' => $this->string(45)->comment('Название (имя) языка'),
            '[[code]]' => $this->string(3)->unique()->notNull()->comment('Код языка'),
            '[[flag]]' => $this->text()->comment('Флаг языка (изображение)'),
            '[[status]]' => $this->boolean()->comment('Язык используеться в системе или нет'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%langs}}');
    }
}
