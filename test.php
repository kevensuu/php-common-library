<?php
require_once __DIR__ . '/vendor/autoload.php';

//echo \KLibrary\Common::formatTime('2019-03-18 8:22:00');

$url = "https://mp.weixin.qq.com/s/c5Lzfn5Z1Y4WZ7TwXvO3uw";

$content = \KLibrary\Weixin::getContent($url);


echo "<pre>";
var_dump($content);