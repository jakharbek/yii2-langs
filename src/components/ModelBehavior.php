<?php
namespace jakharbek\langs\components;

use Yii;
use yii\base\Behavior;
use yii\base\Model;
use yii\db\ActiveRecord;
/*
 * @class применят обязательно к модели ActiveRecord для
 * применение сохранение текушего языка
 */
class ModelBehavior extends Behavior{
    /**
     * @var string - аттрибут языка
     */
    public $attribute = 'lang';
    /**
     * @var string - аттрибут хеша
     */
    public $attribute_hash = Lang::LANG_HASH_GET_NAME;


    /**
     * @var array string|Callable
     * @example
     * ```php
     *   [
     *      'title' => '',
     *      'description => '',
     *      'date_publish' => function($value,$parenet){
     *          return date('d.m.Y',$value);
     *      }
     *   ]
     * ``
     */
    public $fill = [];

    /**
     * @var один из переводов
     */
    private $one_of_the_translates;

    /**
     * @return array
     */
    public function events()
    {
        return [
            Model::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeInsert',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_INIT => 'initial',
        ];
    }

    /**
     * @return void
     */
    public function initial(){
        if(Yii::$app->request->get(Lang::LANG_HASH_GET_NAME)){
            if(!$this->owner->isNewRecord){return;}
            $lang_hash = Yii::$app->request->get(Lang::LANG_HASH_GET_NAME);

            if($this->owner->hasAttribute(Lang::LANG_HASH_GET_NAME)){

                $owner = $this->owner;
                $query_self = $owner::find()->where([$this->attribute_hash => $lang_hash,$this->attribute => Lang::getLangId()]);

                if($query_self->count() > 0){
                    return;
                }
                $query = $owner::find()->where([$this->attribute_hash => $lang_hash]);
                if($query->count() == 0){
                    return;
                }
                $this->one_of_the_translates = (object)$query->asArray()->one();

                if(count($this->fill)){
                    foreach ($this->fill as $field => $callback){
                        if(is_callable($callback)){
                            $this->owner->{$field} = $callback($this->one_of_the_translates->{$field},$this->one_of_the_translates);
                        }else{
                            $this->owner->{$field} = $this->one_of_the_translates->{$field};
                        }
                    }
                }
            }
        }
    }

    /**
     *  @return void
     */
    public function beforeValidate(){
        $this->owner->{$this->attribute} = Lang::getLangId();
    }

    /**
     * @return void
     */
    public function beforeInsert(){

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
        if($this->owner->isNewRecord){
            if(!(strlen($this->owner->{$this->attribute_hash}) > 1)){
                $this->owner->{$this->attribute_hash} = Yii::$app->security->generateRandomString(50);
            }
        }
    }

    /**
     * @return bool
     */
    public function afterDelete(){
        $lang_hash = $this->owner->{$this->attribute_hash};
        $model = $this->owner;
        $models_query = $model::find()->where([$this->attribute_hash => $lang_hash]);
        if($models_query->count() == 0){  return true; }
        $models = $models_query->all();
        foreach ($models as $data){
            $data->delete();
        }
        return true;
    }

    public function setTranslateVersion($translate_version = null){
        if($translate_version == null){return false;}
        $lang_hash = $translate_version->{$this->attribute_hash};
        $this->owner->updateAttributes(['lang_hash' => $lang_hash]);
        $this->owner->save(false);
    }
    public function setLangForce($lang = null){
        if($lang == null){return false;}
        $this->owner->updateAttributes(['lang' => $lang]);
        $this->owner->save(false);
    }
    public function getTranslateVersions(){
        $owner = $this->owner;
        $query = $owner::find()->where(['lang_hash' => $owner->lang_hash]);
        $all = $query->all();
        return $all;
    }
}