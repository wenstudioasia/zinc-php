<?php

namespace Vanderw\ZincPhp;

use Vanderw\ZincPhp\Option\SearchType;

trait Search
{
    /**
     * Searching 
     * 
     * @param string $index
     * @param string $term
     * @param string $search_type       see SearchType.php.
     * @param array[string] $select:    fields(like fields in RDBMS, empty array means all fields which equals '*' in MySQL)
     * @param string $start_time        datetime in string format. eg '2021-12-25T15:08:48.777Z'
     * @param string $endtime
     * @param array[string] $sort_fields    result will sorted by fields in this araray.
     *  - ['Year',] means sort by Year ASC
     *  - ['-Year',] means sort by Year DESC
     * @param int $offset               start position(index)
     * @param int $page_size            max_results
     * @param array $aggregations       see official document
     * @param array $highlight          see offcial document. Need set highlightable=true in index mappings.
     *  sample
     *  {
     *      "number_of_fragments": 1,
     *      "fragment_size": 1,
     *      "pre_tags": ["<mark>"],
     *      "post_tags": ["</mark>"],
     *      "fields": {
     *          "number_of_fragments": 1,
     *          "fragment_size": 1,
     *          "pre_tags": ["<mark>"],
     *          "post_tags": ["</mark>"],
     *      }
     *  }
     * 
     * @return array                    Original data response from Zinc server.
     * 
     */
    public function search(
        string $index,
        string $term,
        string $search_type = SearchType::WILDCARD,
        array $select = [],
        string $start_time = null,
        string $end_time = null,
        array $sort_fields = [],
        int $offset = 0,
        int $page_size = 20,
        array $aggregations = [],
        array $highlight = []
    ): array {
        $json = [
            'search_type' => $search_type,
            'query' => [],
            'from' => $offset,
            'max_results' => $page_size,
        ];
        if (!empty($term)) {
            $json['query']['term'] = $term;
        }
        if (!empty($start_time)) {
            $json['query']['start_time'] = $start_time;
        }
        if (!empty($end_time)) {
            $json['query']['end_time'] = $end_time;
        }
        if (count($sort_fields) > 0) {
            $json['sort_fields'] = $sort_fields;
        }
        if (count($select) > 0) {
            $json['_source'] = $select;
        }
        if (!empty($aggregations)) {
            $json['aggs'] = $aggregations;
        }
        if (!empty($highlight)) {
            $json['highlight'] = $highlight;
        }
        // print_r($json);
        /** @var Api $this */
        $resp = $this->client->request('POST', "/api/$index/_search", ['json' => $json]);
        $arr = Api::json($resp);
        return $arr;
    }
}
