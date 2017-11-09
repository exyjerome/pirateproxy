<?php

require (__DIR__ . '/vendor/autoload.php');

define('piratebay', 'http://thepiratebay.org');
define('proxy_url', 'http://lethargic.alfi.tech:81');

$router = new \Klein\Klein;

$router->respond('[*:url]', function($request, $response){
    $client = new \GuzzleHttp\Client();
    $reqUrl = piratebay . $request->param('url');

    $resp   = $client->request('GET', piratebay . $request->param('url'));
    $resp   = $resp->getBody();
    $resp   = str_replace('//thepiratebay.org', proxy_url, $resp);
    $response->header($resp->getHeaderLine('content-type');

    return $resp;
});

$router->dispatch();
