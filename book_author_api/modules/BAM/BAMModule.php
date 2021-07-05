<?php

namespace app\modules\BAM;

use yii\base\BootstrapInterface;

/**
 * bam module definition class
 */
class BAMModule extends \yii\base\Module implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\BAM\controllers';

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
            ['class' => 'yii\rest\UrlRule', 'controller' => 'book'],
        ], false);
    }
}
