<?php
namespace LaravelRocket\Reviewer\Helpers;

class StringHelper
{
    public static function startsWith($needle, $haystack)
    {
        $length = strlen($needle);

        return substr($haystack, 0, $length) === $needle;
    }

    public static function endsWith($needle, $haystack)
    {
        $length = strlen($needle);
        if ($length === 0) {
            return true;
        }

        return substr($haystack, -$length) === $needle;
    }
}
