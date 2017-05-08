<?php
/**
 * Writes PHP output to a dedicated HTML element on the page
 */

declare(strict_types = 1);

namespace Proclaim;


class Console
{

    private static $messages = array();

    static function PushDump( $variable )
    {
        ob_start();
        var_dump($variable);
        $dump = ob_get_clean();
        self::$messages[] = $dump;
    }

    static function PushString(string $message)
    {
        self::$messages[] = $message;
    }

    static function Display()
    {
        if( proclaim_debug ) {
            Loader::Include('Core.Utilities.Console', 'view', ['messages' => &self::$messages]);
        }
    }

}