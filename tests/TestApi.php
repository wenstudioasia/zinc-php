<?php

namespace tests;

use GuzzleHttp\Exception\ClientException;
use tests\BaseTest;

class TestApi extends BaseTest
{
    public function testVersion()
    {
        $version = $this->zinc->version();
        var_dump($version);

        self::assertTrue(true);
    }

    public function testMetrics()
    {
        try {
            $metrics = $this->zinc->metrics();
            var_dump($metrics);
        } catch (ClientException $e) {
            self::assertTrue(false, 'Make sure enabled prometheus on the serverside:' . $e->getMessage());
        }

        self::assertTrue(true);
    }
}
