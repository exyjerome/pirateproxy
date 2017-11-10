<?php

require (__DIR__ . '/vendor/autoload.php');

define('piratebay', 'http://thepiratebay.org');
define('proxy_url', 'http://lethargic.alfi.tech:81');

$router = new \Klein\Klein;

$router->respond('[*:url]', function($request, $response){
    $client = new \GuzzleHttp\Client();
    $reqUrl = piratebay . $request->param('url');

    $resp   = $client->request('GET', piratebay . $request->param('url'));
    $response->header('content-type', $resp->getHeaderLine('content-type'));
    $resp   = $resp->getBody();
    $resp   = str_replace('//thepiratebay.org', proxy_url, $resp);
    $html   = preg_replace('/<.*?script.*?>.*?<\/.*?script.*?>/igm', '', $resp);

    return $resp;
});

$router->dispatch();
