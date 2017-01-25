<?php

namespace DevGroup\EntitySearch\implementation\db\QueryModifiers;

use DevGroup\EntitySearch\base\SearchEvent;
use yii;

class DefaultWith
{
    public static function modify(SearchEvent $e)
    {
        $searchQuery = $e->searchQuery();


        $mainEntityClassName = $searchQuery->mainEntityClassName;
        if (method_exists($mainEntityClassName, 'defaultWith') === false) {
            return;
        }

        /** @var yii\db\ActiveQuery $activeQuery */
        $activeQuery = &$e->params['activeQuery'];
        $with = $mainEntityClassName::defaultWith();
        $activeQuery->with($with);

    }
}
