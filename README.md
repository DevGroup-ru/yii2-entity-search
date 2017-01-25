Unified ActiveRecord searcher for yii2
======================================
Allows searching ActiveRecords with various conditions, events and addons

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist devgroup/yii2-entity-search "*"
```

or add

```
"devgroup/yii2-entity-search": "*"
```

to the require section of your `composer.json` file.


Usage
-----

TBD


Migration from legacy
---------------------

To migrate from the version when everything was inside of yii2-data-structure-tools.

1. Change the namespace of all used components from `DevGroup\DataStrcuture\search` to:
- `DevGroup\EntitySearch` for base components
- `DevGroup\EntitySearchProperties` if it is property component. You will need `devgroup/yii2-entity-search-properties` package too.
2. Something else???
