<?php

namespace DevGroup\EntitySearch\response;

use DevGroup\EntitySearch\base\SearchableEntity;
use yii;

class ResultResponse extends QueryResponse
{
    /**
     * @var yii\db\ActiveRecord[]|SearchableEntity[]|array Entities
     */
    public $entities = [];
    /** @var  yii\data\Pagination */
    public $pages;
}
