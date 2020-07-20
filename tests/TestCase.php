<?php

namespace Tests;


use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * Class TestCase
 * @package Tests
 */
class TestCase extends PHPUnitTestCase
{
    /**
     * @param $data
     */
    public function dd($data)
    {
        die(var_dump($data));
    }
}