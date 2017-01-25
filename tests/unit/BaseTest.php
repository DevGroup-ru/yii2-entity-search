<?php

namespace DevGroup\EntitySearch\Tests\unit;

use Codeception\Module\Filesystem;
use Codeception\Specify;
use DevGroup\EntitySearch\base\BaseSearch;
use Yii;

class BaseTest extends \Codeception\Test\Unit
{
    use Specify;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        /** @var Filesystem $fs */
        $fs = $this->getModule('Filesystem');

    }

    protected function _after()
    {

    }

    /**
     * @return BaseSearch
     */
    protected function search()
    {
        return Yii::$app->get('search');
    }
    /**
     * @return string
     */
    protected function getDataDir()
    {
        return Yii::getAlias('@app/data');
    }
}