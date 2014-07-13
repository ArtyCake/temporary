<?

class DLL{

    public static function translit($str, $dir = 0){
       $_ru = array(
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я','кс'
        );
        $_en = array(
            'A', 'B', 'V', 'G', 'D', 'E', 'YO', 'ZH', 'Z', 'I', 'I',
            'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
            'H', 'C', 'CH', 'SH', 'SH', '\'', 'I', '\'', 'E', 'YU', 'YA',
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'i',
            'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
            'h', 'c', 'ch', 'sh', 'sh', '\'', 'i', '\'', 'e', 'yu', 'ya','x'
        );
        $_enKey = array(
            'F','<','D','U','L','T','~',':','P','B','Q',
            'R','K','V','Y','J','G','H','C','N','E','A',
            '{','W','X','I','O','}','S','M','"','>','Z',
            'f',',','d','u','l','t','`',';','p','b','q',
            'r','k','v','y','j','g','h','c','n','e','a',
            '[','w','x','i','o',']','s','m','\'','.','z',
        );
        switch ($dir) {
            case 1:
                return str_replace($_ru, $_en, $str);
                break;
            case 2:
                return str_replace($_ru, $_enKey, $str);
                break;
            case 3:
                return str_replace($_ru, $_enKey, str_replace($_en, $_ru, $str));
                // return str_replace($_enKey, $_ru, str_replace($_ru, $_en, $str));
                break;

            default:
                return str_replace($_en, $_ru, $str);
                break;
        }

    }

    public static function getHtmlEncode($str){
        return htmlentities(trim($str), ENT_QUOTES,'UTF-8');
    }

    public static function getHtmlDecode($str){
        return html_entity_decode($str, ENT_QUOTES, 'UTF-8' );
    }


    public static function makeLink($str){
        $_ru = array(
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й',
            'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф',
            'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й',
            'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф',
            'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
        );
        $_en = array(
            'A', 'B', 'V', 'G', 'D', 'E', 'YO', 'ZH', 'Z', 'I', 'I',
            'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F',
            'H', 'C', 'CH', 'SH', 'SH', '\'', 'I', '\'', 'E', 'YU', 'YA',
            'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'i',
            'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f',
            'h', 'c', 'ch', 'sh', 'sh', '\'', 'i', '\'', 'e', 'yu', 'ya'
        );
        return strtolower(preg_replace('/[^0-9-_\+a-zA-Z]/', '', str_replace($_ru, $_en, preg_replace('/ +/', '_', trim(preg_replace('/\(.+?\)/si', '', $str))))));
    }


    public static function getActualDate(){
        $actDate = Yii::app()->db->createCommand("SELECT create_date FROM `products` WHERE is_products = 1 AND deleted = 0 ORDER BY create_date DESC LIMIT 1")->queryRow();
        $actDate = $actDate['create_date'];
        if ($actDate)
        {
            $upDate = Yii::app()->db->createCommand("SELECT change_date FROM `products` WHERE is_products = 1 AND deleted = 0 AND change_date > '{$actDate}' ORDER BY change_date DESC LIMIT 1")->queryRow();
            if ($upDate)
            {$actDate = $upDate['change_date'];}
        }
        return date('d.m.Y',strtotime($actDate));
    }


    public static function idGen()
    {
        $date = date('Y-m-d 00:00:00');
        $tmp = Yii::app()->db->createCommand("SELECT `gen_id` FROM `orders` WHERE `create_date` >= '{$date}' ORDER BY `create_date` DESC LIMIT 1")->queryRow();
        if ($tmp)
            $idGen = $tmp['gen_id']+1;
        else $idGen = (int)date('ymd').'001';

        return $idGen;
    }

      /** Функция разбивает строку на подстроки с указанным количеством символов
     Пример: DLL::splitString('строка', 3)
     * вернет array('стр','тро','рок','ока')
     */
    public static function splitString($string,$count_chars){
        $out = array();
        if(mb_strlen($string, 'UTF-8') <= $count_chars)
        {
            array_push($out, $string);
        }
        else
        {
            for($i = 0; $i<=(mb_strlen($string, 'UTF-8') - $count_chars); $i++)
            {
                $substr = mb_substr($string, $i, $count_chars, 'UTF-8');
                array_push($out, $substr);
            }
        }
        return $out;
    }


    public static function substrText($inputStr,$substrLen = 200,$delimiter = " ",$end = "&nbsp;...",$encoding="utf-8")
    {

        $inputStr = strip_tags($inputStr);
        $inputStrLen = mb_strlen($inputStr,$encoding);
        // return $delimiter;

        if ($inputStrLen)
        {
            if ($substrLen < $inputStrLen)
            {
                $text = mb_substr($inputStr, 0, mb_strrpos(mb_substr($inputStr, 0, $substrLen,$encoding), $delimiter,$encoding),$encoding);
                $result['text'] = $text.$end;
                $result['length'] = mb_strlen($text,$encoding);
                $result['isFull'] = false;
            }
            else
            {
                $result['text'] = $inputStr;
                $result['length'] = $inputStrLen;
                $result['isFull'] = true;
            }
            return $result['text'];
        }
        else return false;
    }
    public static function getShortText($input,$limit=50){
        $text=strip_tags($input);
        if(mb_strlen($text, 'UTF-8')>$limit)
        {
           // $pos = mb_strpos($text, " ", $limit, "UTF-8");
            $text = mb_substr($text, 0, $limit, "UTF-8");
            return $text.'...';
        }
        else
            return $text;
    }


    public static function mb_ucfirst($str,$encoding='utf-8'){
        return mb_substr(mb_strtoupper($str, $encoding), 0, 1, $encoding) . mb_substr($str, 1, mb_strlen($str)-1, $encoding);
    }



    public static function pass_encode($str,$key){
        $res = base64_encode($str).$key;
        $res = base64_encode($res).$key;
        $res = base64_encode($res);
        return $res;
    }

    public static function pass_decode($str,$key){
        $res = base64_decode($str);
        $res = str_replace($key, '', $res);
        $res = base64_decode($res);
        $res = str_replace($key, '', $res);
        $res = base64_decode($res);
        return $res;
    }

    public static function getWordEnd($count,$one = "",$few = "a", $alot = "ов")
    {
        $count = $count%100;
        $cl = $count%10;
        if($cl == 1 and $count != 11){
            $word_end = $one;
        }
        elseif(in_array($cl, array(2,3,4)) and !in_array($count,array(12,13,14))){
            $word_end = $few;
        }
        else{
            $word_end = $alot;
        }
        return $word_end;
    }



    public static function getImgArrayFromText($text)
    {
        $imgArray = array();
        while(strpos($text,'/files/'))
        {
            $from = strpos($text,'/files/');
            $text = substr($text, $from+7);
            $to = strpos($text,'.jpg');
            $img = substr($text, 0,$to+4);
            $imgArray[] = "'".$img."'";
        }
        return $imgArray;
    }

    public static function getPaginate($all, $cur, $near, $link, $span, $dots)
    {
        $f_dots = '';
        $l_dots = '';
        $before = "";
        $after = "";
        $start = "";
        $end = "";
        for ($i=1; $i <= $all; $i++) {
            if($i == 1 and $i!=$cur)
            {
                $start = str_replace('{i}',$i,urldecode($link));
                continue;
            }
            if ($i == $all and $i!=$cur)
            {
                $end .=str_replace('{i}',$i,urldecode($link));
                continue;
            }

            if($i == $cur)
            {
                $curStr =str_replace('{i}',$i,$span);
                continue;
            }

            if($i<$cur){
                if($i >= $cur - $near){
                    $before .= str_replace('{i}',$i,urldecode($link));
                }else{
                    $f_dots = $dots;
                }
            }

            if($i>$cur){
                if($i <= $cur + $near){
                    $after .= str_replace('{i}',$i,urldecode($link));
                }else{
                    $l_dots = $dots;
                }
            }
        }
        return $start.$f_dots.$before.$curStr.$after.$l_dots.$end;

    }


     public static function getRating($count, $site = false){
        if($count > 0)
        {
            $str = '';
            $count = ceil($count);
            for($i = 0; $i<$count; $i++)
            {
                if($site === false)
                {
                    $str .='<i class="icon-star"></i>';
                }
                else
                {
                    $str .= '<img src="/images/star-small-on.png" alt="">';
                }


            }
            $str .= ($site == false)?'&nbsp;&nbsp;&nbsp;':'';
            return $str;
        }
        else
        {
            return '';
        }
    }


    public static function getMonthName($number)
    {
        $year = array(
            '1' => 'Январь',
            '2' => 'Февраль',
            '3' => 'Март',
            '4' => 'Апрель',
            '5' => 'Май',
            '6' => 'Июнь',
            '7' => 'Июль',
            '8' => 'Август',
            '9' => 'Сентябрь',
            '10' => 'Октябрь',
            '11' => 'Ноябрь',
            '12' => 'Декабрь',
        );
        return $year[$number];
    }

    public static function getGenitiveMonthName($number)
    {
        $month = array(
            '1' => 'января',
            '2' => 'февраля',
            '3' => 'марта',
            '4' => 'апреля',
            '5' => 'мая',
            '6' => 'июня',
            '7' => 'июля',
            '8' => 'августа',
            '9' => 'сентября',
            '10' => 'октября',
            '11' => 'ноября',
            '12' => 'декабря',
        );
        return $month[$number];
    }

    public static function getDate($date, $type='short')
    {
        // standart from mysql datetime '2014-05-13 16:44:50'
        //если пустая дата
        if(!$date)
            return '';

        $types = array(
            'short'=>'d MMMM yyyy',
            'full' =>"d MMMM yyyy 'в' HH:mm:ss"
            );
        // если значение datetime на входе
        // if($isDateTime)
        // {
        //     $dateArr = explode(" ", $date);
        //     $time = $dateArr[1];
        // }else{
        //     $dateArr = array($date);
        // }
        $result =Yii::app()->dateFormatter->format($types[$type], $date);
        $short = Yii::app()->dateFormatter->format($types['short'], $date);
        // если $date = сегодня
        if(date('Ymd') == date('Ymd', strtotime($date)))
        {
            return str_replace($short,'Сегодня',$result);
        }
        if(date('Ymd', strtotime($date)) == date('Ymd', strtotime('yesterday')))
        {
            return str_replace($short,'Вчера',$result);
        }
        return $result;
        // преобразование к виду "12 мая 2014"
        // $dateArr = explode("-", $dateArr[0]);
        // $extraParameters = '';
        // if(isset($time) && $returnDateTime && $preposition)
        //     $extraParameters = ' ' .$preposition . ' ' . $time;
        // //VarDumper::dump($time);die();
        // if (isset($dateArr[2]))
        //     return (int)$dateArr[2] . ' ' .self::getGenitiveMonthName((int)$dateArr[1]) . ' ' . $dateArr[0] . $extraParameters;
    }



    public static  function getNewPass()
    {
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max=8;
        $size=StrLen($chars)-1;
        $password=null;
        while($max--)
            $password.=$chars[rand(0,$size)];
        return $password;
    }


    public static function sendSMS($text,$numbers)
    {
        $numbers = is_array($numbers) ? implode(', ', $numbers) : $numbers;
        $sms = new QTSMS('12232','rfhfvtkmrf','service.qtelecom.ru');
        $sms_xml = $sms->post_message($text,$numbers,'LazyTour.ru');
        return htmlspecialchars($sms_xml);
        // $r_xml = $sms->get_balance();
        // return $r_xml;
    }

    public static function getShortLink($salt)
    {
        return substr(sha1($salt),0,6);
    }

    public static function getProjectPercent($percent)
    {
        if($percent > 75){
            $class="green";
            $img = '/images/ok.png';
        }elseif($percent>0){
            $img = '/images/ne-ok.png';
            $class="red";
        }else{
            $img = '/images/x.png';
            $class="gray";
        }
        return '<span class="'.$class.'">'.$percent.'% <img src="'.$img.'" height="10" width="12" alt=""></span>';
    }

    public static function is_file($file)
    {
        if(!$file){
            return false;
        }
        if(is_object($file)){
            return is_file(Yii::getPathOfAlias('webroot').'/files/'.$file->filename);
        }else{
            return false;
        }
    }

    public static function getFileSize($file_name)
    {
        if(!$file_name or !is_string($file_name))
            return false;
        if(!is_file(Yii::getPathOfAlias('webroot').'/files/'.$file_name)){
            return false;
        }
        $size = filesize(Yii::getPathOfAlias('webroot').'/files/'.$file_name);
        if(!$size) return false;
        if($size > 1000*1000)
            return number_format($size/1000/1000,2,',','').' МБ';
        if($size > 1000)
            return number_format($size/1000,0,',','').' КБ';

        return number_format($size,0,',','').' Б';
    }

    public static function getItemsCount($arr,$needle)
    {
        $keys = array_keys($arr);
        $res = 0;
        if($keys)
            foreach ($keys as $haystack) {
                if(strpos($haystack, $needle)!==false)
                    $res++;
            }
        return $res;
    }

    public static function getSwotSums($arr)
    {
        $sums = array();
        $sums['all'] = 0;
        if($arr)
            foreach ($arr as $first_key => $first_value) {
                $sums[$first_key] = 0;
                $sums[$first_key[0].'o'.$first_key[1]] = 0;
                $sums[$first_key[0].'t'.$first_key[1]] = 0;
                foreach ($first_value as $second_key => $second_value) {
                    if(!isset($sums[$second_key]))
                        $sums[$second_key] = 0;
                    $sums['all']+=(int)$second_value->rating;
                    $sums[$first_key]+=(int)$second_value->rating;
                    $sums[$second_key]+=(int)$second_value->rating;
                    $sums[$first_key[0].$second_key[0].$first_key[1]] +=(int)$second_value->rating;
                }
            }
        return $sums;
    }

    public static function getUsedPayment($uid,$objType,$objId)
    {
        // последняя запись этого объекта
        $lastRecordItemId = Yii::app()->db->createCommand('SELECT MAX(id) FROM payments WHERE user_id = '.$uid.' AND object_type="'.$objType.'" AND object_id='.$objId)->queryScalar();
        if ($lastRecordItemId)
        {
            $payment = Payments::model()->findByPk($lastRecordItemId);
            if ($payment->is_used)
                return 1;
        }
        return 0;
    }

    public static function setUsedPayment($uid,$objType,$objId)
    {
        // последняя запись этого объекта
        $lastRecordItemId = Yii::app()->db->createCommand('SELECT MAX(id) FROM payments WHERE user_id = '.$uid.' AND object_type="'.$objType.'" AND object_id='.$objId)->queryScalar();
        if ($lastRecordItemId)
        {
            $payment = Payments::model()->findByPk($lastRecordItemId);
            $payment->is_used = 1;
            $payment->save();
        }

    }

}
