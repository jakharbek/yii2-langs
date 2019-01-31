<?php
namespace jakharbek\langs\components;

use Yii;
use yii\base\Behavior;
use yii\base\Model;
/*
 * @class применят для фильтерации запросов можно в cаму модель можно в query
 * применение текушего языка
 */
class QueryBehavior extends Behavior{
    /*
     * @prop - аттрибут языка
     */
    public $attribute = 'lang';

    public $alias = null;

    public function lang($alias = null){
        if($alias !== null){
            return $this->owner->andWhere([$alias.".".$this->attribute => Lang::getLangId()]);
        }
        if($this->alias !== null){
            return $this->owner->andWhere([$this->alias.".".$this->attribute => Lang::getLangId()]);
        }
        return $this->owner->andWhere([$this->attribute => Lang::getLangId()]);
    }
}