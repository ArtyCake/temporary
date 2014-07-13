<?php
/**
 *
 *
 */

class Constants
{

    //upload constants
    const BANNER_IMG = 'banner_img';
    const LOGO_IMG = 'logo_img';
    const FACE_IMG = 'face_img';
    const ADV_VERTICAL = 'adv_vertical';
    const ADV_HORISONTAL = 'adv_horisontal';
    const USER_LOGO = 'user_logo';
    const BIG_FILE = 'big_file';
    const PROJECT_LOGO = 'project_logo';
    const PROJECT_ITEM = 'project_item';
    const IDEA_IMG = 'idea_img';



    public static function getUploadArray($key=null)
    {
        $array = array();
        $default = array();
        $default['max_size'] = 0; //указывать в мегабайтах; если ноль загружается любого размера
        $default['allowed_types'] = array(); //массив доступных расширений файлов; если пустой загружаются любые файлы. пример array('png','gif');
        $default['is_image'] = 1; // 0 - файл, 1 - изображение; если ноль следующие поля не требуются
        // если width_to и height_to равны нулям изображение загружается как есть
        $default['width_to'] = 0; // ширина к которой сжимается файл; если 0 то пропорционально высоте
        $default['height_to'] = 0; // высота к которой сжимается файл; если 0 то пропорционально широте
        $default['any_size'] = true; // если true то загружается изображение шириной и высотой большими или равными указанным ниже, если false то только строгое совпадение
        $default['width_expect'] = 0; // будут  загружаться изображения шириной не менее указанной
        $default['height_expect'] = 0; // будут  загружаться изображения высотой не менее указанной
        /**
         *  пример массива миниатюр
         *         array(
         *         'm_' => array(
         *                 'width_to'=>'30',
         *                 'height_to'=>'30'
         *                 )
         *         )
         * такой массив приведет к созданию миниатюры от основного изображения размером 30х30 пикселей с именем m_<filename основного изображения>.<расширение основного изображения>
         *
         */
        $default['alter_img'] = array(); // массив доп.миниатюр.


// баннер
        $type = array();
        $type['max_size'] = 5;
        $type['allowed_types'] = array();
        $type['is_image'] = 1;
        $type['width_to'] = 1920;
        $type['height_to'] = 480;
        $type['any_size'] = false;
        $type['width_expect'] = 1920;
        $type['height_expect'] = 480;
        $type['alter_img'] = array(
            'm_'=>array(
                'width_to'=>1024,
                'height_to'=>480
            )
        );
        $array[self::BANNER_IMG] = array_merge($default, $type);

// логотипы на главной в разделе "в нашей команде"
        $type = array();
        $type['max_size'] = 5;
        $type['allowed_types'] = array();
        $type['is_image'] = 1;
        $type['width_to'] = 145;
        $type['height_to'] = 145;
        $type['any_size'] = true;
        $type['width_expect'] = 145;
        $type['height_expect'] = 145;
        /*$type['alter_img'] = array(
            'm_'=>array(
                'width_to'=>1024,
                'height_to'=>'480'
            )
        );*/
        $array[self::LOGO_IMG] = array_merge($default, $type);


        // картинки на главной в разделе "почему ты ещё ждёшь"
        $type = array();
        $type['max_size'] = 5;
        $type['allowed_types'] = array();
        $type['is_image'] = 1;
        $type['width_to'] = 158;
        $type['height_to'] = 158;
        $type['any_size'] = true;
        $type['width_expect'] = 158;
        $type['height_expect'] = 158;
        $type['alter_img'] = array(
            'm_'=>array(
                'width_to'=>97,
                'height_to'=>65
            )
        );
        $array[self::FACE_IMG] = array_merge($default, $type);

// рекламные блоки

        $type = array();
        $type['width_to'] = 650;
        $type['height_to'] = 80;
        $type['any_size'] = false;
        $type['width_expect'] = 650;
        $type['height_expect'] = 80;


        $array[self::ADV_HORISONTAL] = array_merge($default, $type);

        $type = array();
        $type['width_to'] = 300;
        $type['height_to'] = 500;
        $type['any_size'] = false;
        $type['width_expect'] = 300;
        $type['height_expect'] = 500;

		$array[self::ADV_VERTICAL] = array_merge($default, $type);

// аватарка физ/юр. лица
        $type = array();
        $type['name'] = self::USER_LOGO;
        $type['width_to'] = 65;
        $type['height_to'] = 65;
        $type['any_size'] = true;
        $type['width_expect'] = 65;
        $type['height_expect'] = 65;
        $type['alter_img'] = array(
            'm_'=>array(
                'width_to'=>32,
                'height_to'=>32
            )
        );

        $array[self::USER_LOGO] = array_merge($default, $type);

// файлы в проекте
        $type = array();
        $type['max_size'] = 20;
        $type['is_image'] = 0;

        $array[self::BIG_FILE] = array_merge($default, $type);

//логотип проекта
        $type = array();
        $type['max_size'] = 5;
        $type['allowed_types'] = array('png','jpg','jpeg');
        $type['is_image'] = 1;
        $type['width_to'] = 270;
        $type['height_to'] = 270;
        $type['any_size'] = true;
        $type['width_expect'] = 190;
        $type['height_expect'] = 145;

        $array[self::PROJECT_LOGO] = array_merge($default, $type);

//услуги проект:идея
        $type = array();
        $type['max_size'] = 5;
        $type['allowed_types'] = array('png','jpg','jpeg');
        $type['is_image'] = 1;
        $type['width_to'] = 180;
        $type['height_to'] = 180;
        $type['any_size'] = true;
        $type['width_expect'] = 180;
        $type['height_expect'] = 180;

        $array[self::PROJECT_ITEM] = array_merge($default, $type);


//Изображение запроса на идею
        $type = array();
        $type['max_size'] = 3;
        $type['allowed_types'] = array('png','jpg','jpeg');
        $type['is_image'] = 1;
        $type['width_to'] = 195;
        $type['height_to'] = 145;
        $type['any_size'] = true;
        $type['width_expect'] = 195;
        $type['height_expect'] = 145;

        $array[self::IDEA_IMG] = array_merge($default, $type);



        if(!is_null($key) and isset($array[$key]))
            return $array[$key];
        else
            return $array;
    }

    public static function getUploadHelp($type)
    {
        $result = '';
        $conf = self::getUploadArray($type);
        if($conf){
            if($conf['any_size']){
                $result = 'Изображение';
                $and = "";
                if($conf['width_expect']!=0){
                    $result .= " не менее $conf[width_expect]px по ширине";
                    $and = " и";
                }
                if($conf['height_expect']!=0)
                    $result .= "$and не менее $conf[height_expect]px по высоте";

            }else{
                $result = 'Изображение';
                $and = "";
                if($conf['width_expect']!=0){
                    $result .= " $conf[width_expect]px по ширине";
                    $and = " и";
                }
                if($conf['height_expect']!=0)
                    $result .= "$and $conf[height_expect]px по высоте";
            }
        }
        return $result;
    }

    public static function getEmailArray(){
//        $email = array('abz'=>'abz.dn.ua@gmail.com','contacts' => 'gaspar91@bk.ru');
        $email = Emails::model()->findAll();
        return $email;
    }

    public static function getEmailList(){
        $email = Yii::app()->db->createCommand("SELECT email FROM moderators WHERE deleted=0 AND email <>''")->queryAll();
        return $email;
    }

    public static function getStatuses()
    {
        return array(
            'draft'=>'Черновик',
            'not_published_in_moderation'=>'Не опубликована',
            'not_published_moderator_left_a_comment'=>'Не опубликована (комментарий)',
            'published_unchanged'=>'Опубликована',
            'published_moderator_left_a_comment'=>'Опубликована (комментарий)',
            'completed'=>'Завершен',
            'request_for_an_extension_extended'=>'Запрос на продление'
        );
    }

    public static function getIdeasStatuses()
    {
        return array(
            'draft'=>'Черновик',
            'not_published_in_moderation'=>'Не опубликована',
            'not_published_moderator_left_a_comment'=>'Не опубликована (комментарий)',
            'published_unchanged'=>'Опубликована',
            'published_moderator_left_a_comment'=>'Опубликована (комментарий)',
            'the_archive_requires_announce_the_winner'=>'В архиве (Требуется объявить победителя)',
            'the_archive_winner_announced'=>'В архиве (Победитель объявлен)',
            'request_for_an_extension_extended'=>'Запрос на продление'
        );
    }

    public static function getProjectsStatuses($key=null)
    {
        $arr = array(
            'draft_unmoderated'=>'Черновик',
            'not_published_in moderation'=>'Не опубликован',
            'not_published_moderator_left_a_comment'=>'Не опубликован (комментарий)',
            'published_unchanged'=>'Опубликован',
            'published_moderator_left_a_comment'=>'Опубликован (комментарий)',
            'completed_by_user'=>'Завершен пользователем',
            'private_by_user'=>'Скрыт пользователем'
        );
        if(is_null($key)){
            return $arr;            
        }else{
            if(isset($arr[$key]))
                return $arr[$key];
            else
                return false;
        }
    }

    public static function getIdeasResponseStatuses()
    {
        return array(
            'not_published'=>'Не опубликована',
            'published'=>'Опубликована',
        );
    }

    public static function getPaymentStatuses()
    {
        return array(
            'not_paid_publication'=>'Не оплачен (публикация)',
            'paid_publication'=>'Оплачен (публикация)',
            'paid_special_use'=>'Оплачен (публикация спец-размещение)',
            'not_paid_re_publication'=>'Не оплачен (повторная публикация)',
            'paid_re_publication'=>'Оплачен (повторная публикация)',
            'paid_re_publication_special_use'=>'Оплачен  (повторная публикация спец-размещение)',
            'request_for_an_extension_extended'=>'Запрос на продление'
        );
    }

}
