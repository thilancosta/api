<?php

require_once __DIR__ . '../../vendor/autoload.php';

$client = new Zend\Soap\Client('http://localhost/hello/server.php?wsdl');
$result = $client->sayHello(['firstName' => 'World']);

echo $result->sayHelloResult;