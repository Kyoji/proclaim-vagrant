<?php
/**
 * Main Proclaim class.
 */
declare(strict_types = 1);

namespace Proclaim;

class App
{
    public static $url = array();

    public static function init()
    {
        self::$url = parse_url( '//'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] );
        Console::PushDump(self::$url);
    }

}