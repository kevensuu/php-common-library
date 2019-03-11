<?php
require_once __DIR__ . '/vendor/autoload.php';

use KCommon\Common;

$url = 'https://www.codercto.com/daily/l/20190311.html';
$ret = Common::getDomainFromUrl($url);

print_r($ret);