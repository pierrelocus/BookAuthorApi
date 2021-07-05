<?php

namespace app\modules\ADM;

use yii\base\BootstrapInterface;

/**
 * adm module definition class
 */
class ADMModule extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\ADM\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            ['class' => 'yii\rest\UrlRule', 'controller' => 'author'],
        ], false);
    }
}
