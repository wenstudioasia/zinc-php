<?php

namespace Wenstudio\ZincPhp;

trait Document
{
    /**
     * Create a document and index it for searches
     * 
     * @param string $index     index name
     * @param array $doc        document in json format. no need to according mappings predefined.
     * 
     * @return array            demonstract many things. most importants are ok/fail, and the generated doc_id
     * 
     * return array sample:
     * {
     *  "message":"ok",
     *  "id": "",
     *  "_id": "",
     *  "_index": "index name",
     *  "_version": 1,
     *  "_seq_no": 0,
     *  "_primary_term": 0,
     *  "result":"created"
     * }
     */
    public function doc_create(string $index, array $doc): array
    {
        $resp = $this->client->request('POST', "/api/$index/_doc", ['json' => $doc]);
        $arr = Api::json($resp);
        return $arr;
    }

    /**
     * Create a document but use given param as the new doc id.
     * 
     * @param string $index
     * @param mixed $doc_id     int/string to present a new id.
     * @param array $doc
     * 
     * @return array same as doc_create()
     */
    public function doc_create_with_id(string $index, $doc_id, array $doc): array
    {
        $resp = $this->client->request('PUT', "/api/$index/_doc/$doc_id", ['json' => $doc]);
        return Api::json($resp);
    }

    /**
     * Update a doc specied by index and doc_id
     * 
     * @param string $index     index name
     * @param mixed $doc_id     doc id to be updated
     * @param array $doc        document
     * 
     * @return bool 
     */
    public function doc_update(string $index, $doc_id, array $doc): bool
    {
        /**
         * return
         * {
         *  "message":"ok",
         *  "id": "id", // string
         * }
         */
        $resp = $this->client->request('POST', "/api/$index/_update/$doc_id", ['json' => $doc]);
        $arr = Api::json($resp);
        return $arr && $arr['message'] == 'ok' && $arr['id'] == $doc_id;
    }

    /**
     * Delete document by doc_id
     * 
     * @param string $index 
     * @param mixed $doc_id
     * 
     * @return bool
     * 
     * @throws GuzzleHttp\Exception\ClientException 400 Bad Request {"error": "id not found"}
     */
    public function doc_delete(string $index, $doc_id): bool
    {
        /**
         * return
         * {
         *  "message":"deleted",
         *  "index":"index name",
         *  "id": "id in string"
         * }
         */
        $resp = $this->client->request('DELETE', "/api/$index/_doc/$doc_id");
        $arr = Api::json($resp);
        return $arr && $arr['message'] == 'deleted' && $arr['id'] == $doc_id;
    }

    /**
     * Bulk insertion
     * 
     * @param string $ndjson    data in ndjson (newline delimited json)
     *  ndjson format:
     *      First line is index action
     *      Second line is document data
     *  eg.
     *      { "index" : { "_index" : "olympics" } } 
     *      {"Year": 1896, "City": "Athens", "Sport": "Aquatics", "Discipline": "Swimming", "Athlete": "HAJOS, Alfred", "Country": "HUN", "Gender": "Men", "Event": "100M Freestyle", "Medal": "Gold", "Season": "summer"}
     *      { "index" : { "_index" : "olympics" } } 
     *      {"Year": 1896, "City": "Athens", "Sport": "Aquatics", "Discipline": "Swimming", "Athlete": "HERSCHMANN, Otto", "Country": "AUT", "Gender": "Men", "Event": "100M Freestyle", "Medal": "Silver", "Season": "summer"}
     * @return array
     * {
     *  "message":"bulk data inserted",
     *  "record_count": 2,
     * }
     */
    public function doc_bulk(string $ndjson): array
    {
        $resp = $this->client->request('POST', "/api/_bulk", ['body' => $ndjson]);
        $arr = Api::json($resp);
        return $arr;
    }

    /**
     * Bulk insertion v2
     * 
     * @param array $json   data in json format
     * eg.
     *  {
     *      "index": "index name",
     *      "records": [
     *        {
     *         "name": "Prabhat Sharma",
     *         "age": 18
     *         },
     *         {
     *         "name": "Daniel Sharma",
     *         "age": 36
     *         }
     *      ]
     * }
     * 
     * @return array
     * {
     *  "message":"v2 data inserted",
     *  "record_count": 300,
     * }
     */
    public function doc_bulk_v2(array $json): ?array
    {
        $resp = $this->client->request('POST', "/api/_bulkv2", ['json' => $json]);
        $arr = Api::json($resp);
        return $arr;
    }

    /**
     * Insert multiple documents at once.
     * 
     * @param string $index     index name
     * @param string $content   composed as multi-line json documents.
     * eg.
     * { "title": "this is the first document", "attr": "foo" }
     * { "title": "this is the second document", "attr": "bar" }
     * Or.
     * { "_id": "myid", "title": "this is the first document", "attr": "foo" }
     * { "_id": "myid2" "title": "this is the second document", "attr": "bar" }
     * 
     * @return array 
     * {
     *  "message": "multiple data inserted",
     *  "record_count": 2
     * }
     */
    public function doc_multi(string $index, string $content): array
    {
        $resp = $this->client->request('POST', "/api/$index/_multi", ['body' => $content]);
        $arr = Api::json($resp);
        return $arr;
    }
}
