<?php
if (!empty($title)) {
    ?>
    <h2><?= $title ?></h2>
    <?php
}
?>
<ul class="statsul">
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید امروز'); ?></span><span class="value"><?= $items['todayVisit'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید کننده امروز'); ?></span><span class="value"><?= $items['todayVisitor'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید دیروز'); ?></span><span class="value"><?= $items['yesterdayVisit'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید کننده دیروز'); ?></span><span class="value"><?= $items['yesterdayVisitor'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید این ماه'); ?></span><span class="value"><?= $items['thisMonthVisit'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'بازدید ماه گذشته'); ?></span><span class="value"><?= $items['pastMonthVisit'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'کل بازدید ها'); ?></span><span class="value"><?= $items['allVisit'] ?></span></li>
    <li><span class="title"><?= \Yii::t('rabint', 'افراد آنلاین'); ?></span><span class="value"><?= $items['online'] ?></span></li>
    <div class="clearfix"></div>
</ul>
<div class="clearfix"></div>
<style>
    ul.statsul {
        clear: both;
    }
    .statsul li {
        list-style: none;
        clear: both;
        padding-bottom: 6px;
        width: 100%;
        float: right;
        border-bottom: #aaa 1px dotted;
    }

    .statsul .title {
        float: right;
    }
    .statsul .value {
        float: left;
    }


</style>