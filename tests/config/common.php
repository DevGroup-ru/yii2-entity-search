<?php

use yii\helpers\ArrayHelper;

$config = [
    'id' => 'app-test-console',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2_entitysearch',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'search' => [
            'class' => 'DevGroup\EntitySearch\components\Search',
        ],
    ],
];

if (file_exists(__DIR__ . '/common.local.php')) {
    $config = ArrayHelper::merge($config, include(__DIR__ . '/common.local.php'));
}

return $config;