<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Wenstudio\ZincPhp\Zinc;

class BaseTest extends TestCase
{
    /**
     * @var Zinc $zinc
     */
    protected $zinc;

    protected function setUp(): void
    {
        $this->zinc = new Zinc('http://localhost:4080', 'admin', 'aa123456');
    }
}
