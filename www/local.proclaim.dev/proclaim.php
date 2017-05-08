<?php
/**
 * Main entry point of Proclaim
 *
 * Calls all scripts, sets up environment.
 *
 * @author Daniel Owens
 */

declare(strict_types = 1);

namespace Proclaim;

/*
* Define globals for debug and loader
* TODO: Add hook to override these globals
*/
if(!defined("P_DEBUG")){ define("P_DEBUG", 1); }

require_once("core/utilities/loader.interface.php");
require_once("core/utilities/Loader.class.php");

$loader = new Loader;
// $loader->load('core/controllers/router.class', ["loader" => &$loader]);
// $loader->load('core/controllers/pdo.class');
// $loader->load('core/controllers/db.class');
// $loader->load('core/models/post.class');

$loadFirst = [
    ["root" => "core/controllers/", "router.class", "pdo.class", "db.class"],
    "core/models/post.class",
    "vars" => ["loader" => &$loader],
    "loadmode" => "include",
];

$loader->loadMany($loadFirst);

$url =  $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$router = new Router( $url );

$filename = "config/db.json";
$handle = fopen($filename, "r");
$contents = fread( $handle, filesize($filename));
fclose($handle);

$test = json_decode($contents, true);
$db = new MysqlDatabase( $test );
$posts = $db->getPosts();

var_dump($posts);



