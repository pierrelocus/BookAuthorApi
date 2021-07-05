<?php

namespace app\modules\ADM\controllers;

use yii\rest\ActiveController;

/**
 * AuthorController implements the REST API for Authors
 */
class AuthorController extends ActiveController
{
    public $modelClass = 'app\modules\ADM\models\Author';
}
