<?php

namespace App\Tests\unit;

use Faker\Factory;
use Faker\Generator;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Generator */
    protected $faker;

    /**
     * @return Generator
     */
    public function getFaker(): Generator
    {
        if (null === $this->faker) {
            $this->faker = Factory::create();
        }
        return $this->faker;
    }
}
