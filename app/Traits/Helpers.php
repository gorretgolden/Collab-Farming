<?php

namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Helpers
{

    static function storeFile($path, $file, $type = "")
    {
        $filen = $type . '_' . implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));
        $filename = $path . $filen . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put($filename, File::get($file));
        return (object)["name" => $file->getClientOriginalName(), "path" => $filename];
    }

    static function randomColor()
    {
        $colors = [
            '#A3A1FB', '#DDDF00', '#24CBE5', '#64E572', '#FF9655',
            '#9DFCFF', '#FFD59D', '#FC46FC', '#00E5E5', '#E500B9',
            '#6CC476', '#E59F00'
        ];

        return $colors[array_rand($colors)];
    }

    static function randomPassword($length)
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, strlen($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }
        return implode($pass);
    }

    static function response($data, $status)
    {
        return response()->json($data, $status);
    }

    static function messageResponse($message, $status)
    {
        return self::response([
            'message' => $message,
            'status' => $status
        ], $status);
    }

    static function datesPast($num)
    {
        $dates = array();

        $month = date("m");
        $day = date("d");
        $year = date("Y");

        for ($i = 0; $i <= $num; $i++) {
            $dates[] = date('Y-m-d', mktime(0, 0, 0, $month, ($day - $i), $year));
        }
        return $dates;
    }

    static function monthsPast($num)
    {

        $months = array();

        $month = date("m");
        $year = date("Y");

        for ($i = 0; $i <= $num; $i++) {
            $months[] = date('Y-m-d', mktime(0, 0, 0, ($month - $i), 1, $year));
        }
        return $months;
    }

    static function generateRandomString($length)
    {
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $id = array();
        $strLength = strlen($str) - 1;
        for ($i = 0; $i < $length; $i++) {
            $p = mt_rand(0, $strLength);
            $id[] = $str[$p];
        }
        return implode($id);
    }


  
}
