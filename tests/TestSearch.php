<?php

namespace tests;

use tests\BaseTest;
use Wenstudio\ZincPhp\Option\AggregationType;
use Wenstudio\ZincPhp\Option\SearchType;

class TestSearch extends BaseTest
{
    protected $index = 'test'; // official test data

    public function testTerm()
    {
        self::markTestSkipped();

        $res = $this->zinc->search($this->index, 'good');
        var_dump(json_encode($res));
        self::assertTrue(true);
    }

    public function testFields()
    {
        self::markTestSkipped();

        $res = $this->zinc->search($this->index, 'good', SearchType::WILDCARD, ['Athlete', 'City']);
        var_dump(json_encode($res));
        self::assertTrue(true);
    }

    public function testSort()
    {
        self::markTestSkipped();

        $res = $this->zinc->search($this->index, 'goo*', SearchType::WILDCARD, ['Athlete', 'City', 'Year'], '', '', ['-Year']);
        var_dump(json_encode($res));

        self::assertTrue(true);
    }

    public function testAggregation()
    {
        self::markTestSkipped();

        $res = $this->zinc->search(
            $this->index,
            'goo*',
            SearchType::WILDCARD,
            ['Athlete', 'City', 'Year'],
            '',
            '',
            ['-Year'],
            0,
            20,
            [
                'sum_year' => [
                    'agg_type' => AggregationType::SUM,
                    'field' => 'Year',
                ],
                'max_year' => [
                    'agg_type' => AggregationType::MAX,
                    'field' => 'Year',
                ],
            ]
        );
        var_dump(json_encode($res));
        self::assertTrue(true);
    }

    public function testHighlight()
    {
        self::markTestSkipped('Search Highlight have not implemented');

        $res = $this->zinc->search(
            $this->index,
            'good',
            SearchType::WILDCARD,
            ['name', 'age'],
            '',
            '',
            ['-Year'],
            0,
            20,
            [],
            [
                "fields" => [
                    "name" => [
                        "pre_tags" => ["<highlight>"],
                        "post_tags" => ["</highlight>"],
                    ],
                ],
            ]
        );
        var_dump(json_encode($res));

        self::assertTrue(true);
    }
}
