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

    public static function cutOutString($string, $length, $postfix = '...')
    {
        $string = strip_tags(htmlspecialchars_decode($string, ENT_QUOTES));
        $string = trim($string);
        $string = (mb_strlen($string, 'utf-8') <= $length) ? $string : (mb_substr($string, 0, $length, 'utf-8').$postfix);
        return $string;
    }

    /**
     * 获取字符串首个字符字母
     * @param $str
     * @return int|string
     */
    public static function getFirstCharter($str)
    {
        if(empty($str) || mb_strlen($str)<2)
        {
            return '0';
        }

        $str = self::cutOutString($str, 1, '');

        if(preg_match('/\d/', $str))
        {
            return $str;
        }

        $fchar=ord($str{0});
        if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
        $s1=iconv('UTF-8','gb2312',$str);
        $s2=iconv('gb2312','UTF-8',$s1);
        $s=$s2==$str?$s1:$str;

        if(!isset($s{1}))
        {
            return 0;
        }

        $asc=ord($s{0})*256+ord($s{1})-65536;
        if($asc>=-20319&&$asc<=-20284) return 'A';
        if($asc>=-20283&&$asc<=-19776) return 'B';
        if($asc>=-19775&&$asc<=-19219) return 'C';
        if($asc>=-19218&&$asc<=-18711) return 'D';
        if($asc>=-18710&&$asc<=-18527) return 'E';
        if($asc>=-18526&&$asc<=-18240) return 'F';
        if($asc>=-18239&&$asc<=-17923) return 'G';
        if($asc>=-17922&&$asc<=-17418) return 'H';
        if($asc>=-17417&&$asc<=-16475) return 'J';
        if($asc>=-16474&&$asc<=-16213) return 'K';
        if($asc>=-16212&&$asc<=-15641) return 'L';
        if($asc>=-15640&&$asc<=-15166) return 'M';
        if($asc>=-15165&&$asc<=-14923) return 'N';
        if($asc>=-14922&&$asc<=-14915) return 'O';
        if($asc>=-14914&&$asc<=-14631) return 'P';
        if($asc>=-14630&&$asc<=-14150) return 'Q';
        if($asc>=-14149&&$asc<=-14091) return 'R';
        if($asc>=-14090&&$asc<=-13319) return 'S';
        if($asc>=-13318&&$asc<=-12839) return 'T';
        if($asc>=-12838&&$asc<=-12557) return 'W';
        if($asc>=-12556&&$asc<=-11848) return 'X';
        if($asc>=-11847&&$asc<=-11056) return 'Y';
        if($asc>=-11055&&$asc<=-10247) return 'Z';
        return 0;
    }
}