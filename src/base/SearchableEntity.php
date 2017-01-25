<?php

namespace DevGroup\EntitySearch\base;


interface SearchableEntity
{
    /**
     * @return array Array of key=>value for default filtering.
     */
    public static function defaultAttributesScope();

    /** @return array Default with scopes */
    public static function defaultWith();
}
