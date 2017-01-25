<?php

namespace DevGroup\EntitySearch\Tests\models;

use Yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function rules()
    {
        return [
            ['name', 'required'],
            ['sku', 'default', 'value' => 'no_sku'],
            ['is_active', 'boolean',],
            ['price', 'number',]
        ];
    }

    public static function tableName()
    {
        return '{{%product}}';
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('{{%product_category}', ['product_id' => 'id']);
    }
}
