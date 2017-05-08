<?php
/**
 * Proclaim File Loader
 * Converts the supplied pattern into a usable path
 * then includes the specified file
 * Core root directories are: core, themes, extensions
 * Core suffixes are: model, view, interface, class
 * Aliases take the form of: root.child.child.file.optional_suffix
 */

declare(strict_types = 1);

namespace Proclaim;

class Loader implements FileLoader
{

    private $usedPaths;
    private $roots;
    private $alias;
    private $path;
    private $includePath;
    private $suffixes;
    
    function __construct()
    {
        $this->roots = [ "core" => "core", "extensions" => "extensions", "themes" => "themes"];
        $this->suffixes = [ "class" => "class", "interface" => "interface", "view" => "view", "model" => "model" ];
        $this->includePath = $_SERVER["DOCUMENT_ROOT"];
    }

    public function addSuffix( string $suffix )
    {
        $this->suffixes[$suffix] = $suffix;
    }

    private function preparePath()
    {
        $this->cleanAlias();
        $this->formPathFromAlias();
        if(!file_exists($this->path))
            throw new \Exception("Loader->load() requires the file exists, path given: ".$this->path, 1);
    }

    public function load( string $alias, array $vars = [], string $loadMode = "include" )
    {   
        $this->alias = $alias;
        if(null == $this->usedPaths[$alias])
        {
            $this->preparePath();
            $this->includeFile($loadMode, $vars);
        } else {
            $this->path = $this->usedPaths[$alias];
            $this->includeFile($loadMode, $vars);
        }
        
    }

    public function loadMany( array $aliases )
    {
        echo count($aliases);
        foreach ($aliases as $aliasRoot) {
            if(is_array($aliasRoot))
            {
                for ($i=0; $i<count($aliasRoot); $i++) {
                    echo $i;
                    $path = $aliasRoot["root"].$aliasRoot[$i];
                    $this->load( $path, $aliases['vars'], $aliases['loadmode']);                   
                }
            } else {
                $this->load( $aliasRoot, $aliases['vars'], $aliases['loadmode']);
            }
        }
    }

    private function cleanAlias()
    {
        $this->alias = strtolower($this->alias);
    }

    private function formPathFromAlias()
    {
        $this->path = "";
        //$tmp = explode(".", $this->alias);
        $tmp = explode("/", $this->alias);
        var_dump($tmp);

        // Check to make sure its a valid root
        // if( !strlen($this->roots[$tmp[0]]) ) 
        //     throw new \Exception("Loader->load() requires a valid root", 1);
        $count = count($tmp);

        // If a suffx is detected, combine the last 2 entries in the path array with a '.'
        // $hasSuffix = ($this->suffixes[ $tmp[$count - 1] ] != null);
        // if($hasSuffix) 
        // {
        //     $tmp[$count - 2] .= ".".$tmp[$count - 1]; // Combine the last 2 splices
        //     array_splice($tmp, $count - 1);
        //     $count--; 
        // }
        // Form the path, then add the alias => path association
        for($i = 0; $i < $count - 1; $i++)
            $this->path .= $tmp[$i]."/";
        $this->path .= $tmp[$count - 1].".php";
        $this->usedPaths[$this->alias] = $this->path;
    }

    private function includeFile( string $loadMode, array $vars )
    {
        switch($loadMode)
        {
            case "require":
                if( count($vars) > 0 )
                    extract($vars);
                require($this->path);
                break;
            case "require_once":
                if( count($vars) > 0 )
                    extract($vars);
                require_once($this->path);
                break;
            default:
            case "include":
                if( count($vars) > 0 )
                    extract($vars);
                include($this->path);
                break;
        }
    }

}