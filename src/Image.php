<?php

namespace KLibrary;

class Image
{
    public static function grabImageToLocal($url, $dir)
    {
        if(!$url)
        {
            return '';
        }

        $new_dir = '/'.date('Y').'/'.date('m').'/'.date('d').'/';
        $dir = $dir.$new_dir;
        if(!file_exists($dir))
        {
            mkdir($dir, '0777', 1);
        }

        $filename = hash_file('md5', $url).'.png';

        ob_start();//打开输出
        readfile($url);//输出图片文件
        $img = ob_get_contents();//得到浏览器输出
        ob_end_clean();//清除输出并关闭
        $size = strlen($img);//得到图片大小
        $fp2 = @fopen($dir.$filename, "a");
        fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
        fclose($fp2);

        return $new_dir.$filename;
    }
}