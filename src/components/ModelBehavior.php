<?php
namespace jakharbek\langs\components;

use Yii;
use yii\base\Behavior;
use yii\base\Model;
/*
 * @class применят обязательно к модели ActiveRecord для
 * применение сохранение текушего языка
 */
class ModelBehavior extends Behavior{
    /*
     * @prop - аттрибут языка
     */
    public $attribute = 'lang';
    /*
     * @prop - аттрибут хеша
     */
    public $attribute_hash = Lang::LANG_HASH_GET_NAME;

    public function events()
    {
        return [
            Model::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }
    public function beforeValidate(){

        if(Yii::$app->request->get(Lang::LANG_HASH_GET_NAME))
        {
            $lang_hash = Yii::$app->request->get(Lang::LANG_HASH_GET_NAME);
            $this->owner->{$this->attribute_hash} = $lang_hash;
        }
        if(Yii::$app->request->post(Lang::LANG_HASH_GET_NAME))
        {
            $lang_hash = Yii::$app->request->post(Lang::LANG_HASH_GET_NAME);
            $this->owner->{$this->attribute_hash} = $lang_hash;
        }

        $this->owner->{$this->attribute} = Lang::getLangId();
    }
}