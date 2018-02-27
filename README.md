Langs
==========
Langs

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jakharbek/yii2-langs "*"
```

or add

```
"jakharbek/yii2-langs": "*"
```

to the require section of your `composer.json` file.


Usage
-----
execute the migration here

```
yii migrate --migrationPath=@vendor/jakharbek/yii2-langs/src/migrations
```
in backend part add this code

``` 
    'on beforeAction' => function () {
        jakharbek\langs\components\Lang::onRequestHandler();
    },

```

Once the extension is installed, simply use it in your code by  :
 
 
 You need to create in your model (table in the database) for translation for the field ```[[lang]]``` and the field ```[[lang_hash]]```
 then add the behavior to the model ```ActiveRecord```
 ``` 
 jakharbek\langs\components\ModelBehavior 
 ```
 
 example
 
 ```
 
'lang' => [
            'class' => ModelBehavior::className(),
           ],
           
 ```
 
 
 View
 -----
 To use on the page you had a translation you need to lead
   widget 
 ```
 \jakharbek\langs\widgets\LangsWidgets::widget();
 ```
   this widget has two modes of operation: single and multiple.
   When you specify the model property to be translated:
```
\jakharbek\langs\widgets\LangsWidgets::widget(['model_db' => $model,'create_url' => '/url/to/create/']);
```
   then it is in solitary if you do not specify  ```model_db```  then it will work
   in multiple modes
 
 If you need to take into account the current language in the requests, then you can use the behavior
 ```php
 \jakharbek\langs\components\QueryBehavior
 ```
after applying the behavior you can now use it as an example:
 ```php
 YourModel::find()->lang()->...
 ```