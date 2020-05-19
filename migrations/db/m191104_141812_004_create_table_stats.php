<?php

use yii\db\Migration;

class m191104_141812_004_create_table_stats extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stats}}', [
            'id' => $this->integer(10)->unsigned()->notNull()->append('AUTO_INCREMENT PRIMARY KEY')->comment('شناسه'),
            'date' => $this->date()->comment('تاریخ'),
            'visit' => $this->integer(10)->unsigned()->comment('تعداد بازدید'),
            'visitor' => $this->integer(10)->unsigned()->comment('تعداد کاربر'),
            'member_visit' => $this->integer(11)->notNull()->defaultValue('0')->comment('بازدید کاربران عضو'),
            'member_visitor' => $this->integer(11)->notNull()->defaultValue('0')->comment('کاربران عضو بازدید کننده'),
            'most_hour' => $this->text()->comment('ساعات اوج بازدید'),
            'visit_in_hour' => $this->text()->comment('بازدید در هر ساعت'),
            'interface' => $this->text()->comment('واسط کاربر'),
            'maturities' => $this->text()->comment('بازدید به تفکیک رده سنی'),
            'genders' => $this->text()->comment('بازدید به تفکیک جنسیت'),
            'countries' => $this->text()->comment('بازدید کشور ها'),
            'most_error_action' => $this->text()->comment('بیشترین اکشنهای دارای خطا'),
            'most_visited_action' => $this->text()->comment('بیشترین اکشنهای بازدید شده'),
            'most_visitor_user' => $this->text()->comment('بیشترین کاربران بازدید کننده'),
            'agents' => $this->text()->comment('مرورگر ها'),
            'referer' => $this->text()->comment('مراجع لینک'),
            'error' => $this->integer(11)->comment('تعداد خطاها'),
            'restricted' => $this->integer(11)->comment('جلوگیری شده'),
            'restricted_ip' => $this->text()->comment('آی پی های بلاک شده'),
            'utms' => $this->text()->comment('utms'),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%stats}}');
    }
}
