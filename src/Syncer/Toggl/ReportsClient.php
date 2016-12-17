<?php

namespace Syncer\Toggl;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\VarDumper\VarDumper;

/**
 * Class ReportsClient
 * @package Syncer\Toggl
 *
 * @author Matthieu Calie <matthieu@calie.be>
 */
class ReportsClient
{
    const VERSION = 'v2';

    /**
     * @var Client;
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var string
     */
    private $api_key;

    /**
     * TogglClient constructor.
     * @param Client $client
     * @param SerializerInterface $serializer
     * @param $api_key
     */
    public function __construct(Client $client, SerializerInterface $serializer, $api_key)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->api_key = $api_key;
    }

    public function getWeeklyReport($workSpaceId)
    {
        $res = $this->client->request('GET', self::VERSION . '/weekly', [
            'auth' => [$this->api_key, 'api_token'],
            'query' => ['user_agent' => 'matthieu@calie.be', 'workspace_id' => $workSpaceId]
        ]);

        Vardumper::dump(json_decode($res->getBody()->getContents()));die;
    }
}
