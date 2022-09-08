<?php

namespace Wenstudio\ZincPhp\Option;

/**
 * doc: https://docs.zincsearch.com/api/index/update-mapping/
 */
class Mappings
{
    protected $mappings;

    public function __construct(array $mappings = [])
    {
        $this->mappings = $mappings;
    }

    protected function filter(array $mapping): array
    {
        $ret = [];
        if (isset($mapping['type'])) {
            $ret['type'] = $mapping['type'];
        }
        if (isset($mapping['index'])) {
            $ret['index'] = $mapping['index'];
        }
        if (isset($mapping['store'])) {
            $ret['store'] = $mapping['store'];
        }
        if (isset($mapping['sortable'])) {
            $ret['sortable'] = $mapping['sortable'];
        }
        if (isset($mapping['aggregatable'])) {
            $ret['aggregatable'] = $mapping['aggregatable'];
        }
        if (isset($mapping['highlightable'])) {
            $ret['highlightable'] = $mapping['highlightable'];
        }

        if (($mapping['type'] ?? '') == FieldType::DATE) {
            if (isset($mapping['format'])) {
                $ret['format'] = $mapping['format'];
            }
            if (isset($mapping['time_zone'])) {
                $ret['time_zone'] = $mapping['time_zone'];
            }
        }

        return $ret;
    }

    public function build(): array
    {
        $ret = [];

        foreach ($this->mappings as $name => $mapping) {
            if (!is_string($name) || empty($name)) {
                continue;
            }
            $ret[$name] = $this->filter($mapping);
        }
        return $ret;
    }
}
