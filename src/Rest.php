<?php 
namespace Wisdomanthoni\ApiModel;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class Rest {
    function __construct($headers = null)
    {
        $this->baseUrl = config('apimodel.baseUrl');
        $this->headers = $headers;
    }

    public static function set($method,$endpoint,$query)
    {
        switch ($method) {
            case 'get':
                $m = 'GET';
                break;
            case 'post':
                $m = 'POST';
                break;
            case 'put':
                $m = 'PUT';
                break;
            default:
               return ;
                break;
        }
        return self::request($m, $endpoint, ['query' => $query]);
    }

    public function request($method, $url, $data)
    {
        try {
            $client = new Client(['base_uri' => $this->baseUrl, 'verify' => false]);
            $response = $client->request($method, $url, $data);
            return $this->formatResponse($response);
        } catch (RequestException $e) {

            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }
    }

    public function formatResponse($response)
    {
      // $body = $response->getBody()->getContents();
        $body = json_decode($response->getBody()->getContents(), true);

        return $body;
    }   

}