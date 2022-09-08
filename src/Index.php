<?php

namespace Wenstudio\ZincPhp;

use Wenstudio\ZincPhp\Option\StorageType;

trait Index
{
    private function build_mapping(array $mappings): array
    {
        $ret = [];
        foreach ($mappings as $m) {
            if (!isset($m['name'])) {
                continue;
            }
            $name = $m['name'];
            unset($m['name']);
            $ret[$name] = $m;
        }

        return $ret;
    }

    /**
     * @param string $index     index name.
     * @param array $mappings      schemes
     *      format: 
     *      [
     *      'field_name' => {
     *          'type' => <FieldType>
     *          'index' => boolean, // searchable
     *          'store' => boolean, // highlightable
     *          'sortable' => boolean,  // default enabled for numeric & date type
     *          'aggregatable' => boolean,  // same as above.
     *          'highlightable' => boolean, // default false
     *          'time_zone' => '',  // only for date type
     *          'format' => '',     // only for date type
     *      },
     *      'field_2_name' => {
     *          'type' => <FieldType>
     *          'index' => boolean,
     *          'store' => boolean,
     *          'sortable' => boolean,
     *          'aggregatable' => boolean,
     *          'highlightable' => boolean,
     *          'time_zone' => '',
     *          'format' => '',
     *      }]
     * @param array $setting        settings of index. see official docs
     * @param string $storage_type  see StorageType.php
     * @param int $shard_num        default 3, Determined by `ZINC_SHARD_NUM`
     * @return bool                 demonstrate success or not
     * 
     * @throws  GuzzleHttp\Exception\ClientException    400 Bad Request index has already exists.
     * 
     */
    public function index_create(
        string $index,
        array $mappings = [],
        array $settings = [],
        string $storage_type = StorageType::DISK,
        int $shard_num = Api::DEF_SHARD_NUM
    ): bool {
        $body = [
            'name' => $index,
            'storage_type' => $storage_type,
        ];

        if ($shard_num != Api::DEF_SHARD_NUM) {
            $body['shard_num'] = $shard_num;
        }
        if (!empty($mappings)) {
            $body['mappings'] = [
                'properties' => $mappings,
            ];
        }
        if (!empty($settings)) {
            $body['settings'] = $settings;
        }
        /**
         * return
         * 
         * {
         *  "message":"ok",
         *  "index":"$index",
         *  "storage_type":"disk"
         * }
         * 
         * @var Zinc $this
         */
        $resp = $this->client->request('POST', "/api/index", ['json' => $body]);
        $arr = Api::json($resp);

        return $arr && ($arr['message'] ?? '') == 'ok';
    }

    // public function index_update(
    //     string $index,
    //     array $mappings = [],
    //     array $settings = [],
    //     string $storage_type = StorageType::DISK,
    //     int $shard_num = 3
    // ): bool {
    //     return $this->index_create($index, $mappings, $settings, $storage_type, $shard_num, false);
    // }

    public function index_delete(string $index): bool
    {
        /**
         * return {"message": "deleted"}
         * @var Zinc $this
         */
        $resp = $this->client->request('DELETE', "/api/index/$index");
        $arr = Api::json($resp);
        return $arr && ($arr['message'] ?? '') == 'deleted';
    }

    /**
     * @param {array} $options: 
     * page_num = 1,
     * page_size = 20, 
     * sort_by = 'name', 
     * desc = false, 
     * name = '' : fuzzy query by name
     */
    public function index_list(array $options = []): ?array
    {
        $query = [];
        if (isset($options['page_num'])) {
            $query['page_num'] = $options['page_num'];
        }
        if (isset($options['page_size'])) {
            $query['page_size'] = $options['page_size'];
        }
        if (isset($options['sort_by'])) {
            $query['sort_by'] = $options['sort_by'];
        }
        if (isset($options['desc'])) {
            $query['desc'] = $options['desc'];
        }
        if (isset($options['name'])) {
            $query['name'] = $options['name'];
        }

        $resp = $this->client->request('GET', '/api/index', [
            'query' => $query,
        ]);
        $arr = Api::json($resp);
        return $arr;
    }

    /**
     * @param {string} $query_name: fuzzy query by name
     */
    public function index_name_list(string $query_name): array
    {
        $resp = $this->client->request('GET', '/api/index_name', ['query' => ['name' => $query_name]]);
        $arr = Api::json($resp);
        return ($arr ?? []);
    }

    public function index_mapping(string $index): array
    {
        $resp = $this->client->request('GET', "/api/$index/_mapping");
        $arr = Api::json($resp);
        return $arr;
    }

    /**
     * Update index mappings
     * 
     */
    public function index_mapping_update(string $index, array $mappings = []): bool
    {
        $json = [];
        if (!empty($mappings)) {
            $json['properties'] = $mappings;
        }
        // return {"message":"ok"}
        $resp = $this->client->request('PUT', "/api/$index/_mapping", [
            'json' => $json,
        ]);
        $arr = Api::json($resp);
        return $arr && ($arr['message'] ?? '') == 'ok';
    }

    public function index_settings(string $index): array
    {
        $resp = $this->client->request('GET', "/api/$index/_settings");
        $arr = Api::json($resp);
        return $arr;
    }

    public function index_settings_update(string $index, array $settings = []): bool
    {
        $body = json_encode($settings, JSON_FORCE_OBJECT);
        // return {"message":"ok"}
        $resp = $this->client->request('PUT', "api/$index/_settings", ['body' => $body]);
        $arr = Api::json($resp);
        return $arr && ($arr['message'] ?? '') == 'ok';
    }

    public function index_refresh(string $index): bool
    {
        // return {"message":"ok"}
        $resp = $this->client->request('POST', "api/index/$index/refresh");
        $arr = Api::json($resp);
        return $arr && ($arr['message'] ?? '') == 'ok';
    }

    public function index_exists(string $index): bool
    {
        $resp = $this->client->request('HEAD', "/api/index/$index");
        return $resp->getStatusCode() == 200;
    }
}
