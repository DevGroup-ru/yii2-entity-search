<?php

namespace DevGroup\EntitySearch\Tests\unit;

use DevGroup\EntitySearch\base\BaseSearch;
use DevGroup\EntitySearch\base\SearchResponse;
use DevGroup\EntitySearch\response\ResultResponse;
use DevGroup\EntitySearch\Tests\models\Product;
use Yii;

class BaseSearchTest extends BaseTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        parent::_before();
        $this->tester->haveFixtures([
            'categories' => [
                'class' => \DevGroup\EntitySearch\Tests\fixtures\Category::className(),
                'dataFile' => __DIR__ . '/../data/categories.php',
            ],
            'products' => [
                'class' => \DevGroup\EntitySearch\Tests\fixtures\Product::className(),
                'dataFile' => __DIR__ . '/../data/products.php',
            ],
            'bindings' => [
                'class' => \DevGroup\EntitySearch\Tests\fixtures\ProductCategory::className(),
                'dataFile' => __DIR__ . '/../data/product_category.php',
            ]
        ]);
    }

    public function testSearchProducts()
    {
        /** @var BaseSearch $searcher */
        $searcher = $this->search();
        $query = $searcher->searchFromJson([
            'mainEntityClassName' => Product::class,
            'searchQuery' => [
                'pagination' => true,
                'limit' => 3,
                'mainEntityAttributes' => [
                    'is_active' => true,
                ],
                'order' => 'id',
            ],
        ]);
        /** @var ResultResponse $response */
        $response = $query->search(BaseSearch::SEARCH_RESULT);
        $this->assertCount(3, $response->entities);
        $this->assertSame(5, $response->searchQuery->pagination->totalCount);
        $this->assertSame('EXS-123', $response->entities[0]->sku);
        codecept_debug($response);
    }
}
