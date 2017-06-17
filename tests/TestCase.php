<?php

namespace ElfSundae\Laravel\Datatables\Test;

use Mockery;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function tearDown()
    {
        Mockery::close();
    }
}
