<?php

namespace DevGroup\EntitySearch\base;

use DevGroup\EntitySearch\eventHandlers\QueryModifiers\DisablePropertiesAutoFetch;
use DevGroup\EntitySearch\eventHandlers\QueryModifiers\FetchProperties;
use DevGroup\EntitySearch\response\CountResponse;
use DevGroup\EntitySearch\response\IdsResponse;
use DevGroup\EntitySearch\response\ResultResponse;
use DevGroup\EntitySearch\response\QueryResponse;
use yii;

abstract class AbstractSearcher extends yii\base\Component
{
    const EVENT_BEFORE_PAGINATION = 'before-pagination';
    const EVENT_AFTER_PAGINATION = 'after-pagination';
    const EVENT_AFTER_FIND = 'after-find';
    const EVENT_INIT = 'searcher-init';

    /** @var AbstractWatcher|array */
    public $watcher;

    /**
     * @param \DevGroup\EntitySearch\base\SearchQuery $searchQuery
     * @param int $returnType Return type(count, query, result, ids)
     * @return SearchResponse
     */
    abstract public function search(SearchQuery $searchQuery, $returnType = BaseSearch::SEARCH_RESULT);

    public function init()
    {

    }

    /**
     * @param int $returnType
     *
     * @return SearchResponse
     */
    protected static function newResponse($returnType = BaseSearch::SEARCH_RESULT)
    {
        switch ($returnType) {
            case BaseSearch::SEARCH_COUNT:
                return new CountResponse();
                break;
            case BaseSearch::SEARCH_RESULT_ARRAY:
            case BaseSearch::SEARCH_RESULT:
                return new ResultResponse();
                break;
            case BaseSearch::SEARCH_IDS:
                return new IdsResponse();
                break;
            case BaseSearch::SEARCH_QUERY:
            default:
                return new QueryResponse();
                break;
        }
    }
}
