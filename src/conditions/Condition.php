<?php

namespace DevGroup\EntitySearch\conditions;

abstract class Condition
{
    /** @var string */
    public $tableName;

    /** @var string */
    public $field;

    public $expression;
}
