<?php

/**
 *
 *  General functions
 *
 */

use Carbon\Carbon;

\Carbon\Carbon::setLocale('pt_BR');

class Helper
{

    static function set_filename_random($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function convertdata_todb($data)
    {
        return (Carbon::createFromFormat('d/m/Y H:i:s', $data)->format('Y-m-d H:i:s'));
    }

    static function convertdata_tosite($data, $time = TRUE)
    {
//        return (Carbon::parse($data)->format('d/m/Y' . ($time ? ' H:i:s' : '')));
        return (Carbon::parse($data)->format('d/m/Y' . ($time ? ' H:i:s' : '')));
    }


    static function sanitizeString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)

        return $str;
    }

}
