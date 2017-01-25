<?php
$faker = Faker\Factory::create();
return [
    [
        'name' => $faker->name(),
        'sku' => 'EXS-123',
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 1,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 0,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 1,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 0,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 1,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 0,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 1,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 0,
    ],
    [
        'name' => $faker->name(),
        'sku' => $faker->shuffleString('AYZ123-789'),
        'price' => $faker->randomFloat(2, 1, 10),
        'is_active' => 1,
    ],
];
