<?php

use Morilog\Jalali\Jalalian;
use Hekmatinasser\Verta\Verta;

if (! function_exists('lang')) {
    function lang($key, $replace = [], $locale = null)
    {
        return __($key, $replace, $locale);
    }
}

if (! function_exists('isActive')) {
    function isActive($patterns, $class = 'active')
    {
        foreach ((array)$patterns as $pattern) {
            if (request()->routeIs($pattern) || request()->is($pattern)) {
                return $class;
            }
        }
        return '';
    }
}

if (!function_exists('formatVertaDate')) {
    /**
     * Format a date using Verta.
     *
     * @param int $timestamp
     * @return string
     */
    function formatVertaDate($timestamp)
    {
        return Verta::createTimestamp($timestamp)->formatDifference();
    }
}

function toCarbonDate($date)
{
    if ($date === null) {
        return null;
    }

    $jalaliDate = Jalalian::fromFormat('Y/m/d', $date);
    $miladiDate = $jalaliDate->toCarbon();
    $formattedDate = $miladiDate->format('Y-m-d');
    return $formattedDate;
}
function toShamsiDate($date)
{
    if ($date === null) {
        return null;
    }
    $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
    $jalaliDate = \Morilog\Jalali\Jalalian::fromCarbon($carbonDate);
    $formattedDate = $jalaliDate->format('Y/m/d');
    return $formattedDate;
}
//encode string
function encryption($string)
{
    $string = base64_encode($string . "|1^1|" . $string);
    return $string;
}
//decode string
function decryption($string)
{
    return explode("|1^1|", base64_decode($string))[0];
}
