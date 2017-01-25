<?php

namespace DevGroup\EntitySearch\response;

use DevGroup\EntitySearch\base\SearchResponse;
use yii;

class QueryResponse extends SearchResponse
{
    /** @var yii\db\ActiveQuery */
    public $query;
}
