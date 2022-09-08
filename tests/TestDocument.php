<?php

namespace tests;

use tests\BaseTest;

class TestDocument extends BaseTest
{
    public function testCreate()
    {
        self::markTestSkipped();

        $res = $this->zinc->doc_create('test', [
            'name' => 'Jenifer Good',
            'age' => 34,
            'role' => 'mother',
        ]);
        var_dump($res);

        $res = $this->zinc->doc_create_with_id('test', 138, [
            'name' => 'With ID',
            'age' => 333,
        ]);
        var_dump($res);

        self::assertTrue(true);
    }

    public function testUpdate()
    {
        self::markTestSkipped();

        $res = $this->zinc->doc_update('test', 138, [
            'name' => 'With id updated',
            'age' => 334,
        ]);
        self::assertTrue($res);

        self::assertTrue(true);
    }

    public function testDelete()
    {
        self::markTestSkipped();

        $ok = $this->zinc->doc_delete('test', 138);
        self::assertTrue($ok);

        self::assertTrue(true);
    }

    public function testBulk()
    {
        self::markTestSkipped();

        $ndjson = '
            { "index" : { "_index" : "test" } } 
            {"name":"bulk1","age":11}
            { "index" : { "_index" : "test" } } 
            {"name":"bulk11","age":12}';
        $arr = $this->zinc->doc_bulk($ndjson);
        self::assertTrue(($arr['record_count'] ?? 0) == 2);

        self::assertTrue(true);
    }
    public function testBulkV2()
    {
        self::markTestSkipped();

        $data = [
            "index" => "test",
            "records" => [
                ["name" => "Prabhat Sharma", "age" => 23],
                ["name" => "Daniel Sharma", "age" => 25],
            ]
        ];
        $arr = $this->zinc->doc_bulk_v2($data);
        self::assertTrue(($arr['record_count'] ?? 0) == count($data['records']));

        self::assertTrue(true);
    }

    public function testMulti()
    {
        self::markTestSkipped();

        $docs = '
        {"name":"multi1","age":12}
        {"name":"multi2","age":13}
        ';

        $arr = $this->zinc->doc_multi('test', $docs);
        self::assertTrue(($arr['record_count'] ?? 0) == 2);

        self::assertTrue(true);
    }
}
