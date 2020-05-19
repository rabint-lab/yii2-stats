<?php

use yii\db\Migration;

class m191104_141812_003_create_table_stat_dailies extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stat_dailies}}', [
            'id' => $this->bigInteger(20)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY')->comment('شناسه'),
            'time' => $this->integer(11)->comment('زمان درخواست'),
            'user_id' => $this->integer(10)->unsigned()->defaultValue('0')->comment('شناسه کاربر'),
            'maturity' => $this->integer(11)->defaultValue('0')->comment('رده سنی'),
            'gender' => $this->tinyInteger(4)->defaultValue('0')->comment('جنسیت'),
            'request' => $this->text()->comment('لینک درخواست'),
            'status_code' => $this->integer(11)->comment('کد پاسخ'),
            'agent' => $this->string(255)->comment('مرورگر کاربر'),
            'ip' => $this->string(45)->comment('آی پی'),
            'request_type' => $this->string(255)->comment('نوع درخواست'),
            'request_params' => $this->text()->comment('پارامتر های درخواست'),
            'utm' => $this->text()->comment('کمپین های تبلیغاتی'),
            'referer' => $this->text()->comment('لینک مرجع'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%stat_dailies}}');
    }
}
