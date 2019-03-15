<?php

namespace KLibrary;

class Weixin
{
    public static function getContent()
    {
        // 获取页面内容
        $htmlContent = file_get_contents('https://mp.weixin.qq.com/s/c5Lzfn5Z1Y4WZ7TwXvO3uw');

        $data = [];

        // 标题
        preg_match('/var msg_title = "(.*?)";/', $htmlContent, $match);
        if($match)
        {
            $data['title'] = $match[1];
        }

        // 描述
        preg_match('/var msg_desc = "(.*?)";/', $htmlContent, $match);
        if($match)
        {
            $data['desc'] = $match[1];
        }

        // 微信号
        

        var_dump($data);

    }
}