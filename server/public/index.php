<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$httpOrigin = $_SERVER['HTTP_ORIGIN'] ?? '*';
header('Access-Control-Allow-Headers: content-type');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Origin: *' . $httpOrigin);
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die(true);
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
