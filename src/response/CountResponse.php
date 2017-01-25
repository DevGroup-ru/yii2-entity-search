<?php

namespace DevGroup\EntitySearch\response;

use DevGroup\EntitySearch\base\SearchableEntity;
use yii;

class CountResponse extends QueryResponse
{
    /**
     * @var int
     */
    public $count = 0;

}
