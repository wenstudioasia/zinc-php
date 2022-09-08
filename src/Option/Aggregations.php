<?php

namespace Wenstudio\ZincPhp\Option;

/**
 * doc: https://docs.zincsearch.com/api/search/aggregation/#request
 */
class Aggregations
{
    protected $aggs;

    public function __construct(array $aggregations = [])
    {
        $this->mappings = $aggregations;
    }

    protected function filter(array $conf): array
    {
        $ret = [];
        if (isset($mapping['agg_type'])) {
            $ret['agg_type'] = $mapping['agg_type'];
        }
        if (isset($mapping['field'])) {
            $ret['field'] = $mapping['field'];
        }
        if (isset($mapping['size'])) {
            $ret['size'] = $mapping['size'];
        }
        return $ret;
    }

    public function build(): array
    {
        $ret = [];

        foreach ($this->aggs as $name => $conf) {
            if (!is_string($name) || empty($name)) {
                continue;
            }
            $ret[$name] = $this->filter($conf);
        }
        return $ret;
    }
}
