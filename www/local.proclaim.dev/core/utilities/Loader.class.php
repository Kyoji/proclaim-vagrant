<?php

/**
 * Handles registering and loading of files
 *
 * Path association: Core.Utilities.Loader = /utilities/Loader.class.php
 */
declare(strict_types = 1);

namespace Proclaim;

class Loader
{
    // $dirMap is an associative array of virtual -> real paths
    // $root is empty, default value is "core/"
    private static $dirMap = array();
    private static $root = "";

    /**
     * Takes a virtual path (Core.Utilities) and assigns it a real path (core/utilities)
     * @param string $virtual
     * @param string $real
     * @param string $root
     */
    public static function Register( string $virtual, string $real, string $root = 'core/' )
    {
        $pos = strrpos($root, '/');
        if( $pos === false) {
            $root .= '/';
        }
        self::$dirMap[$virtual] = $root.$real;
    }

    /**
     * For the passed abstracted path eg Core.Utilities.Loader,
     * find the correct file and included it.
     * In this case, the file is Loader.class.php, the directory core/utilities
     * @param string $file
     * @param string $type the type of file to be accessed
     * @param array $vars An array of values to pass to the included script
     */
    public static function Include( string $file, string $type = "class", array $vars = [] )
    {
        // Determine if the passed abstract path has at least one dot
        $pos = strrpos($file, '.');
        if ($pos === false)
        {
            die('Error: need at least one dot');
        }

        // Create sub strings for virtual path matching ($path)
        // and file loading ($file)
        $path = substr($file, 0, $pos);
        $file = substr($file, $pos + 1);
        $full_path = self::$root . self::$dirMap[$path] . '/' . $file;

        // Double check the virtual directory is registered for the passed file name
        if (!isset(self::$dirMap[$path]))
        {
            die('Error: Virtual directory not registered: '.$path);
        }

        // Look for *.class.php first, *.php second
        // If neither found, throw error.
        $withType = $full_path. '.' . $type . '.php';
        $noType = $full_path . '.php';
        if (file_exists( $withType )) {
            extract( $vars );
            include( $withType );
        } else if(file_exists( $noType )) {
            extract( $vars );
            include( $noType );
        } else {
            die('Error: File not found: '.$file);
        }
    }
}