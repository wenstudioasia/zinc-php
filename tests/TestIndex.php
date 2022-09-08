<?php

namespace tests;

use Exception;
use GuzzleHttp\Exception\ClientException;
use tests\BaseTest;
use Wenstudio\ZincPhp\Option\FieldType;
use Wenstudio\ZincPhp\Option\StorageType;

class TestIndex extends BaseTest
{
    public function testCreate()
    {
        self::markTestSkipped();

        try {
            $suc = $this->zinc->index_create('test', [
                'name' => [
                    'type' => FieldType::TEXT,
                    'store' => true,
                    'highlightable' => true,
                ],
                'age' => [
                    'type' => FieldType::NUMERIC,
                    'sortable' => true,
                    'aggregatable' => true,
                ],
            ]);
            self::assertTrue($suc);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // $suc = $this->zinc->index_delete('test');
        // self::assertTrue($suc);

        self::assertTrue(true);
    }

    public function testList()
    {
        self::markTestSkipped();

        $res = $this->zinc->index_list();
        var_dump($res);

        $res = $this->zinc->index_name_list('f');
        self::assertIsArray($res);

        self::assertTrue(true);
    }

    public function testMapping()
    {
        self::markTestSkipped();

        $res = $this->zinc->index_mapping('test');
        var_dump($res);

        $res = $this->zinc->index_mapping_update('test', [
            'namex' => [
                'type' => FieldType::TEXT,
                'store' => true,
                'highlightable' => true,
            ],
            'agex' => [
                'type' => FieldType::NUMERIC,
                'sortable' => true,
                'aggregatable' => true,
            ],
        ]);
        self::assertTrue($res);

        $res = $this->zinc->index_mapping('test');
        var_dump($res);

        self::assertTrue(true);
    }

    public function testSettings()
    {
        self::markTestSkipped();

        $res = $this->zinc->index_settings('test');
        var_dump($res);

        $res = $this->zinc->index_settings_update('test');
        self::assertTrue($res);

        self::assertTrue(true);
    }

    public function testOthers()
    {
        self::markTestSkipped();

        $res = $this->zinc->index_refresh('test');
        self::assertTrue($res);

        $res = $this->zinc->index_exists('test');
        self::assertTrue($res);

        self::assertTrue(true);
    }


    public function testDelete()
    {


        self::assertTrue(true);
    }
}
