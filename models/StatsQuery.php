<?php

namespace rabint\stats\models;

/**
 * This is the ActiveQuery class for [[Stats2]].
 *
 * @see Stats2
 */
class StatsQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      $this->andWhere('[[status]]=1');
      return $this;
      } */

    /**
     * @inheritdoc
     * @return Stats2[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Stats2|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
