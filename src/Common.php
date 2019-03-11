<?php

namespace Common;

class Common
{
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
}