<?php

namespace KLibrary;

class Weixin
{
    public static function getContent($url)
    {
        // 获取页面内容
        $htmlContent = file_get_contents($url);

        $data = [];

        // 文章标题
        preg_match('/var msg_title = \'(.*?)\'\.html\(false\);/', $htmlContent, $title);
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
        preg_match('/<div class="rich_media_content " id="js_content" style="visibility: hidden;">(.*?)<\/div>/isu', $htmlContent, $content);
        if($content)
        {
            $content = trim($content[1]);
            $content= preg_replace('/ style="(.*?)"/isu', '', $content);
            $content= preg_replace('/ class="(.*?)"/isu', '', $content);
            $content= preg_replace('/ data-copyright="(.*?)"/isu', '', $content);
            $content= preg_replace('/ data-s="(.*?)"/isu', '', $content);
            $content= preg_replace('/ data-w="(.*?)"/isu', '', $content);
            $content= preg_replace('/ data-type="(.*?)"/isu', '', $content);
            $content= preg_replace('/ data-ratio="(.*?)"/isu', '', $content);
            $content= preg_replace('/<p><br  \/><\/p>/isu', '', $content);
            $content= preg_replace('/data-src="/isu', 'src="', $content);
            $content = preg_replace('/<section><br  \/><\/section>/', '', $content);
            $content = preg_replace('/ data-backh="(.*?)"/', '', $content);
            $content = preg_replace('/ powered-by="(.*?)"/', '', $content);
            $content = preg_replace('/ data-backw="(.*?)"/', '', $content);
            $content = preg_replace('/ data-autoskip="(.*?)"/', '', $content);
            $content = preg_replace('/ data-cropselx1="(.*?)"/', '', $content);
            $content = preg_replace('/ data-cropselx2="(.*?)"/', '', $content);
            $content = preg_replace('/ data-cropsely1="(.*?)"/', '', $content);
            $content = preg_replace('/ data-cropsely2="(.*?)"/', '', $content);
            $content = preg_replace('/ width="(.*?)"/', '', $content);
            $content = preg_replace('/<p><span><br  \/></span><\/p>/', '', $content);
            $content = preg_replace('/<section><br><span><\/span><\/section>/', '', $content);
            $data['content'] = trim($content);
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

        return $data;
    }
}