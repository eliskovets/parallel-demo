<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

$client = new Client(['base_uri' => 'http://apache/']);

// 5 parallel fast requests
echo "5 parallel requests to fast.php" . PHP_EOL;
echo date('c'). ": Start" . PHP_EOL;
$promises = [
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),];
$responses = Promise\settle($promises)->wait();
echo date('c'). ": Done" . PHP_EOL;

// 5 parallel slow requests
echo "5 parallel requests to slow.php" . PHP_EOL;
echo date('c'). ": Start" . PHP_EOL;
$promises = [
	$client->getAsync('/slow.php'),
	$client->getAsync('/slow.php'),
	$client->getAsync('/slow.php'),
	$client->getAsync('/slow.php'),
	$client->getAsync('/slow.php'),
];
$responses = Promise\settle($promises)->wait();
echo date('c'). ": Done" . PHP_EOL;

// our case 3 parallel requests to fast and 2 requests to slow with 1 sec timeout
echo "5 parallel requests: 3 to fast.php and 2 to slow.php with timeout 1 sec" . PHP_EOL;
echo date('c'). ": Start" . PHP_EOL;
$promises = [
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),
	$client->getAsync('/fast.php'),
	$client->getAsync('/slow.php', ['timeout' => 1]),
	$client->getAsync('/slow.php', ['timeout' => 1]),
];
$responses = Promise\settle($promises)->wait();
echo date('c'). ": Done" . PHP_EOL;