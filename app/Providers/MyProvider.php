<?php

namespace App\Providers;

use App\CurrencyConvert;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class MyProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        session()->regenerate();
    }
    static function get_languages()
    {
        $lang_props = array(

//            'ar' => array(
//                'title' => 'العربية' ,
//                'dir' => 'rtl' ,
//                'active' => TRUE ,
//                'theme_postfix' => '' ,
//                'flag' => 'iraq-flag.png' ,
//            ),
            'fa' => array(
                'title' => 'فارسی' ,
                'dir' => 'rtl' ,
                'active' => TRUE ,
                'theme_postfix' => '' ,
                'flag' => 'iran-flag.png' ,
            ) ,
//            'en' => array(
//                'title' => 'English' ,
//                'dir' => 'ltr' ,
//                'active' => TRUE ,
//                'theme_postfix' => '' ,
//                'flag' => 'english--flag.png' ,
//            ),
            // 'af' => array(
            //     'title' => 'پارسی دری' ,
            //     'dir' => 'rtl' ,
            //     'active' => FALSE ,
            //     'theme_postfix' => '' ,
            //     'flag' => 'afgha-flag.png' ,

            // ) ,
            // 'ps' => array(
            //     'title' => 'پشتو' ,
            //     'dir' => 'rtl' ,
            //     'active' => FALSE ,
            //     'theme_postfix' => '' ,
            //     'flag' => 'afgha-flag.png' ,

            // ) ,
            // 'ka' => array(
            //     'title' => 'گرجی' ,
            //     'dir' => 'ltr' ,
            //     'active' => FALSE ,
            //     'theme_postfix' => '' ,
            //     'flag' => '' ,

            // ) ,
        );
        return $lang_props;
    }
    static function get_languages_array()
    {
        $result=array();
        $lang_props = self::get_languages();
        foreach ($lang_props as $key=>$item)
        {
            $result[$key]=$key;
        }
        return $result;
    }

    static function _text($str = '' , $setLang = '')
    {
        $lang=App::getLocale();
        $arr = explode('@@' , $str);
        $setLang = empty($setLang) ? $lang : $setLang;
        if(!empty($arr[1]))
        {
            $en = '';
            foreach ($arr as $value)
            {
                $ar = explode('==' , $value);
                if(!empty($ar[1]))
                {
                    if($ar[0] == $setLang)
                        return $ar[1];
                    elseif($ar[0] == 'en')
                        $en = $ar[1];
                }
            }
            return $en;
        }
        return $str;
    }
    static function _insert_text($env,$str = '')
    {
        $lang_props = self::get_languages();
        $return_str = '@@';
        foreach ((array) $env as $key => $value)
        {
            $var = explode('_', $key);
            if(isset($var[1]) && $var[0] == $str)
            {
                foreach ($lang_props as $k => $v)
                {
                    if($var[1] == $k)
                    {
                        $vars = $value;
                        $return_str .= "$k==$vars@@";
                        if(count($lang_props)==1)
                            return $vars;
                    }
                }
            }
        }

        //$return_str = trim($return_str , '@@');
        return $return_str;
    }
    static function _insert_text_lang($str,$lang='en')
    {
        $return_str = "@@"."$lang==$str";
        return $return_str;
    }



    //CurrencyPrice


    static  function getCurrencyPrice()
    {
        return ['IRR'=>'IRR','EUR'=>'EUR','AFN'=>'AFN','USD'=>'USD','GEL'=>'GEL'];
    }
    static function exToLocal($price,$currence="IRR"){
        $price=(double) $price;
        $currencyLIVE=self::currencyLIVE();
        $price=$currencyLIVE[$currence][session('Local_Currency')]*$price;
        if(session('Local_Currency')=='IRR')
        {
            $price=round($price,-3);
        }else{
            $price=round($price,3);
        }
        return $price;
    }
    static function exToLocalDiscount($price,$discount,$currence="IRR")
    {
        $price=(double) $price;

        if($discount>0)
        {
            $price=$price-$price*($discount/100);
        }
        $price=self::exToLocal($price);
        return $price;
    }
    static function currencyLIVE(){
        if(session('Local_Currency')==null)
            session(['Local_Currency' => 'IRR']);
        $result  = CurrencyConvert::all();

        foreach ($result as $res) {
            $Curency[$res->exFrom][$res->exTo] = $res->rate;
        }
        return $Curency;
    }



    static function convert_phone_number($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, $string);
        $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

        return $englishNumbersOnly;
    }



    static function show_date($date,$format="'Y/n/j H:i:s'") {
        $lang=App::getLocale();
        if($lang=="fa")
        {
            $v = new Verta($date);
			$v = $v->timezone('Asia/Tehran');
            return $v->format($format);

        }else{
            return $date->format($format);
        }
    }



}



