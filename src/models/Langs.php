<?php

namespace jakharbek\langs\models;

use Yii;

/**
 * This is the model class for table "langs".
 *
 * @property int $lang_id Идентификатор языка
 * @property string $name Название (имя) языка
 * @property string $code Код языка
 * @property string $flag Флаг языка (изображение)
 * @property bool $status Язык используеться в системе или нет
 *
 * @property Activities[] $activities
 * @property Attanment[] $attanments
 * @property Castings[] $castings
 * @property Categories[] $categories
 * @property Images[] $images
 * @property Pages[] $pages
 * @property Persons[] $persons
 * @property Posts[] $posts
 * @property Rewards[] $rewards
 * @property Serials[] $serials
 * @property Settings[] $settings
 * @property Topics[] $topics
 * @property Tvprogrammes[] $tvprogrammes
 * @property Tvprojects[] $tvprojects
 * @property Videos[] $videos
 */
class Langs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'langs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'required'],
            [['flag'], 'string'],
            [['status'], 'boolean'],
            [['name'], 'string', 'max' => 45],
            [['code'], 'string', 'max' => 3],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Идентификатор языка',
            'name' => 'Название (имя) языка',
            'code' => 'Код языка',
            'flag' => 'Флаг языка (изображение)',
            'status' => 'Язык используеться в системе или нет',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activities::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttanments()
    {
        return $this->hasMany(Attanment::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCastings()
    {
        return $this->hasMany(Castings::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Pages::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersons()
    {
        return $this->hasMany(Persons::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRewards()
    {
        return $this->hasMany(Rewards::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSerials()
    {
        return $this->hasMany(Serials::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Settings::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topics::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvprogrammes()
    {
        return $this->hasMany(Tvprogrammes::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvprojects()
    {
        return $this->hasMany(Tvprojects::className(), ['lang' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['lang' => 'lang_id']);
    }

    /**
     * @inheritdoc
     * @return LangsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LangsQuery(get_called_class());
    }
}
