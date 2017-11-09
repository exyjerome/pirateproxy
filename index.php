<?php

require (__DIR__ . '/vendor/autoload.php');

define('piratebay', 'http://thepiratebay.org');

$router = new \Klein\Klein;

$router->respond('[*:url]', function($request, $response){
    $client = new \GuzzleHttp\Client();
    $reqUrl = piratebay . $request->param('url');
    var_dump($reqUrl);
    $resp   = $client->request('GET', piratebay . $request->param('url'));
    echo $resp->getBody();
});

$router->dispatch();
