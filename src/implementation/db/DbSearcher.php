<?php

namespace DevGroup\EntitySearch\implementation\db;

use DevGroup\EntitySearch\base\AbstractSearcher;
use DevGroup\EntitySearch\base\BaseSearch;
use DevGroup\EntitySearch\base\SearchableEntity;
use DevGroup\EntitySearch\base\SearchEvent;
use DevGroup\EntitySearch\base\SearchQuery;
use DevGroup\EntitySearch\base\SearchResponse;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\DefaultAttributesScope;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\DefaultWith;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\LimitOffset;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\MainEntityAttributes;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\OrderBy;
use DevGroup\EntitySearch\implementation\db\QueryModifiers\RelationAttributes;
use DevGroup\EntitySearch\response\CountResponse;
use DevGroup\EntitySearch\response\IdsResponse;
use DevGroup\EntitySearch\response\ResultResponse;
use DevGroup\EntitySearch\response\QueryResponse;
use yii;

class DbSearcher extends AbstractSearcher
{
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_PAGINATION, [DefaultAttributesScope::class, 'modify']);
        $this->on(self::EVENT_BEFORE_PAGINATION, [DefaultWith::class, 'modify']);
        $this->on(self::EVENT_BEFORE_PAGINATION, [MainEntityAttributes::class, 'modify']);
        $this->on(self::EVENT_BEFORE_PAGINATION, [RelationAttributes::class, 'modify']);
        $this->on(self::EVENT_BEFORE_PAGINATION, [OrderBy::class, 'modify']);

        $this->on(self::EVENT_AFTER_PAGINATION, [LimitOffset::class, 'modify']);

    }

    /**
     * @param \DevGroup\EntitySearch\base\SearchQuery $searchQuery
     * @param int                                             $returnType Return type(count, query, result, ids)
     *
     * @return SearchResponse
     */
    public function search(SearchQuery $searchQuery, $returnType = BaseSearch::SEARCH_RESULT)
    {
        $response = static::newResponse($returnType);

        /** @var yii\db\ActiveRecord|SearchableEntity $mainEntityClassName */
        $mainEntityClassName = $searchQuery->mainEntityClassName;

        $activeQuery = $mainEntityClassName::find();

        $success = false;

        // combine query
        $e = new SearchEvent(
            $searchQuery,
            $returnType,
            $response,
            [
                'params' => [
                    'activeQuery' => &$activeQuery,
                ],
            ]
        );
        $this->trigger(self::EVENT_BEFORE_PAGINATION, $e);

        // Pagination
        $pages = $searchQuery->getPagination();
        if ($returnType !== BaseSearch::SEARCH_COUNT && $pages !== null) {
            if ($pages->totalCount === 0) {
                $pages->totalCount = (int) $activeQuery->count();
            }
            $searchQuery->limit = $pages->limit;
            $searchQuery->offset = $pages->offset;
        }

        $e = new SearchEvent(
            $searchQuery,
            $returnType,
            $response,
            [
                'params' => [
                    'activeQuery' => &$activeQuery,
                    'pages' => $pages,
                ],
            ]
        );
        $this->trigger(self::EVENT_AFTER_PAGINATION, $e);

        $response->searchQuery = $searchQuery;

        switch ($returnType) {
            case BaseSearch::SEARCH_COUNT:
                /** @var CountResponse $response */
                $response->count = (int) $activeQuery->count();
                $success = true;
                break;
            case BaseSearch::SEARCH_QUERY:
                /** @var QueryResponse $response */
                $response->query = $activeQuery;
                $success = true;
                break;
            case BaseSearch::SEARCH_RESULT_ARRAY:
            case BaseSearch::SEARCH_RESULT:
                /** @var ResultResponse $response */
                // query for debug
                $response->query = $activeQuery;
                if (is_object($pages)) {
                    $response->pages = $pages;
                }
                if ($returnType === BaseSearch::SEARCH_RESULT_ARRAY) {
                    $activeQuery->asArray(true);
                }
                $response->entities = $activeQuery->all();
                $e = new SearchEvent(
                    $searchQuery,
                    $returnType,
                    $response,
                    [
                        'params' => [
                            'activeQuery' => &$activeQuery,
                        ],
                    ]
                );
                $this->trigger(self::EVENT_AFTER_FIND, $e);
                $success = true;
                break;
            case BaseSearch::SEARCH_IDS:
                /** @var IdsResponse $response */
                $activeQuery->select(
                    array_map(
                        function ($item) use ($mainEntityClassName) {
                            return $mainEntityClassName::tableName() . '.' . $item;
                        },
                        $mainEntityClassName::primaryKey()
                    )
                );
                $response->ids = $activeQuery
                    ->distinct(true)
                    ->asArray(true)
                    ->column();
                $response->query = $activeQuery;
                $success = true;
                break;
        }

        return $response->end($success);
    }
}
