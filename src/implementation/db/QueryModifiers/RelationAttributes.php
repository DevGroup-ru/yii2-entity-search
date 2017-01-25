<?php

namespace DevGroup\EntitySearch\implementation\db\QueryModifiers;

use DevGroup\EntitySearch\base\SearchEvent;
use yii;

class RelationAttributes
{
    public static function modify(SearchEvent $e)
    {
        $searchQuery = $e->searchQuery();
        if (count($searchQuery->relationAttributes) === 0) {
            return;
        }

        /** @var yii\db\ActiveQuery $activeQuery */
        $activeQuery = &$e->params['activeQuery'];
        $counter = 1;
        foreach ($searchQuery->relationAttributes as $relation => $attributes) {
            $r = "relAttr_$counter";
            $activeQuery->innerJoinWith(
                "$relation $r",
                false
            );
            foreach ($attributes as $key => $value) {
                if (mb_strpos($key, '.') === false) {
                    $key = "$r.$key";
                }
                $activeQuery->andWhere([$key => $value]);
            }
        }
        //! @todo add relation properties support here
    }


}
