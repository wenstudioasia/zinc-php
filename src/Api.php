<?php

namespace Wenstudio\ZincPhp;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use SebastianBergmann\Type\NullType;
use Wenstudio\ZincPhp\Option\Analyze\Analyzer;

class Api
{
    const DEF_SHARD_NUM = 3;

    const STORAGE_TYPE_DIST = 'disk';
    const STORAGE_TYPE_S3 = 's3';
    const STORAGE_TYPE_MINIO = 'minio';

    /**
     * @var GuzzleHttp\Client $client
     */
    protected $client = null;

    public function __construct(string $endpoint = 'http://127.0.0.1:4080', string $username, string $password)
    {
        $this->client = new Client([
            'auth' => [
                $username, $password,
            ],
            'base_uri' => $endpoint,
            'timeout' => 2.0,
        ]);
    }

    public static function json(ResponseInterface $resp): ?array
    {
        if (!$resp) {
            throw new RuntimeException('network error?');
        }

        if ($resp->getStatusCode() !== 200) {
            echo 'API return failure status code:' . $resp->getStatusCode();
            return null;
        }

        $body = $resp->getBody();
        return json_decode($body, true);
    }

    /**
     * Get Zinc server version information
     * 
     * Fields:
     * version, build, commit_hash, branch, build_date
     */
    public function version(): ?array
    {
        $resp = $this->client->get('/version');
        return self::json($resp);
    }

    /**
     * Get metrics of ZincSearch in prometheus format.
     * 
     * This should set environment ZINC_PROMETHEUS_ENABLE=true
     */
    public function metrics()
    {
        $resp = $this->client->get('/metrics');
        return self::json($resp);
    }

    /**
     * Analyze the text and generate tokens.
     * 
     * @param Analyzer $analyzer @see Analyzer.php
     * @param string $text text to be analyzed
     * 
     * @return array analyzed result
     */
    public function analyze(Analyzer $analyzer, string $text): array
    {
        $resp = $this->client->request('POST', '/api/_analyze', ['json'=>[
            'analyzer' => $analyzer,
            'text' => $text,
        ]]);
        return self::json($resp);
    }
}
