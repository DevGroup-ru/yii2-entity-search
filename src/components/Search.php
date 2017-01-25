<?php

namespace DevGroup\EntitySearch\components;

use DevGroup\EntitySearch\base\BaseSearch;
use DevGroup\EntitySearch\implementation\db\DbSearcher;

class Search extends BaseSearch
{
    /** @inheritdoc */
    public $searchers = [
        DbSearcher::class,
    ];
}
