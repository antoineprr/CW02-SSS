<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController extends Controller
{

    public static function getTextColor(?string $hexColor): string
    {
        if (!$hexColor) {
            return '#ffffff';
        }
        
        $hex = ltrim($hexColor, '#');
        $red = hexdec(substr($hex, 0, 2));
        $green = hexdec(substr($hex, 2, 2));
        $blue = hexdec(substr($hex, 4, 2));
        
        $brightness = ($red * 0.299 + $green * 0.587 + $blue * 0.114);
        
        return $brightness > 186 ? '#000000' : '#ffffff';
    }
}
