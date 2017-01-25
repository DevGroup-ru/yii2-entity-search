<?php

namespace DevGroup\EntitySearch\implementation\db\QueryModifiers;

use DevGroup\EntitySearch\base\SearchEvent;

class OrderBy
{
    public static function modify(SearchEvent $e)
    {
        $searchQuery = $e->searchQuery();
        if ($searchQuery->order !== null) {
            /** @var \yii\db\ActiveQuery $activeQuery */
            $activeQuery = &$e->params['activeQuery'];
            $activeQuery->orderBy($searchQuery->order);
        }

    }
}
