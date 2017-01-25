<?php

namespace DevGroup\EntitySearch\implementation\db\QueryModifiers;

use DevGroup\EntitySearch\base\SearchEvent;
use yii;

class MainEntityAttributes
{
    public static function modify(SearchEvent $e)
    {
        $searchQuery = $e->searchQuery();
        if (count($searchQuery->mainEntityAttributes) === 0) {
            return;
        }

        /** @var yii\db\ActiveQuery $activeQuery */
        $activeQuery = &$e->params['activeQuery'];
        $activeQuery->andFilterWhere($searchQuery->mainEntityAttributes);

    }
}
