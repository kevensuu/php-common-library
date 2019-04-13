<?php
namespace KLibrary;

class Common
{
    public function __construct()
    {
        date_default_timezone_set('PRC');
    }

    /**
     * 从URL中提取域名
     * @param $url
     * @return string
     */
    public static function getDomainFromUrl($url)
    {
        $url = trim($url);
        if(!$url)
        {
            return '';
        }

        $url = parse_url($url);
        return strtolower($url['host']);
    }

    /**
     * 格式化数字
     * @param $num
     * @return float|int
     */
    public static function formatNum($num)
    {
        $num = (int)$num;
        $num = abs($num);

        if($num < 1000)
        {
            return $num;
        }

        $num = ($num/1000);
        $num = round($num, 1);

        return $num.'k';
    }

    /**
     * 格式化时间
     * @param $time
     * @return false|float|int|string
     */
    public static function formatTime($time)
    {
        $timestamp = strtotime($time);
        if(!$timestamp)
        {
            return '';
        }

        $cTimestamp = time();

        $diffTime = $cTimestamp - $timestamp;

        if($diffTime < 1)
        {
            return '刚刚';
        }

        if($diffTime < 60)
        {
            return "{$diffTime}秒前";
        }

        if($diffTime < 3600)
        {
            $diffTime = floor($diffTime/60);
            return "{$diffTime}分钟前";
        }

        if($diffTime<86400)
        {
            $diffTime = floor($diffTime/3600);
            return "{$diffTime}小时前";
        }

        $weekTime = 86400*7;
        if($diffTime < $weekTime)
        {
            $diffTime = floor($diffTime/86400);
            return "{$diffTime}天前";
        }

        $monthTime = 86400*7*4;
        if($diffTime < $monthTime)
        {
            $diffTime = floor($diffTime/$weekTime);
            return "{$diffTime}周前";
        }

        $yearTime = 86400*365;
        if($diffTime < $yearTime)
        {
            $diffTime = floor($diffTime/$monthTime);
            return "{$diffTime}个月前";
        }

        $diffTime = floor($diffTime/$yearTime);
        return "{$diffTime}年前";
    }
}