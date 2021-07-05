<?php

namespace app\modules\BAM\controllers;

use yii\rest\ActiveController;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends ActiveController
{
    public $modelClass = 'app\modules\BAM\models\Book';
}
