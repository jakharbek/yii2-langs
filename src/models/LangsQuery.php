<?php

namespace jakharbek\langs\models;

/**
 * This is the ActiveQuery class for [[Langs]].
 *
 * @see Langs
 */
class LangsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=true');
    }

    /**
     * @inheritdoc
     * @return Langs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Langs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    /**
     * @inheritdoc
     * Получает язык по коду языка
     * @return Langs|array|null
     */
    public function code($code = null)
    {
        return parent::where(['code' => $code]);
    }
}
