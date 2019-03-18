<?php

namespace KLibrary;

class Weixin
{
    public static function getContent()
    {
        // 获取页面内容
        $htmlContent = file_get_contents('https://mp.weixin.qq.com/s/c5Lzfn5Z1Y4WZ7TwXvO3uw');

        $data = [];

        // 文章标题
        preg_match('/var msg_title = "(.*?)";/', $htmlContent, $title);
        if($title)
        {
            $data['title'] = $title[1];
        }

        // 文章描述
        preg_match('/var msg_desc = "(.*?)";/', $htmlContent, $desc);
        if($desc)
        {
            $data['desc'] = $desc[1];
        }

        // 文章内容
        preg_match('/<div class="rich_media_content " id="js_content">(.*?)<\/div>/isu', $htmlContent, $content);
        if($content)
        {
            $content = trim($content[1]);
            $content= preg_replace('/ style="(.*?)"/isu', '', $content);
            $content= preg_replace('/ class="(.*?)"/isu', '', $content);
            $data['content'] = $content;
        }

        // 微信号昵称
        preg_match('/<strong class="profile_nickname">(.*?)<\/strong>/', $htmlContent, $nickname);
        if($nickname)
        {
            $data['nickname'] = $nickname[1];
        }

        // 微信号
        preg_match('/<label class="profile_meta_label">微信号<\/label>(.*?)<span class="profile_meta_value">(.*?)<\/span>/isu', $htmlContent, $weixinNum);
        if($weixinNum)
        {
            $data['weixinNum'] = $weixinNum[2];
        }

        // 微信号介绍
        preg_match('/<label class="profile_meta_label">功能介绍<\/label>(.*?)<span class="profile_meta_value">(.*?)<\/span>/isu', $htmlContent, $weixinNumDesc);
        if($weixinNumDesc)
        {
            $data['weixinNumDesc'] = $weixinNumDesc[2];
        }
        var_dump($data);

        return $data;
    }
}