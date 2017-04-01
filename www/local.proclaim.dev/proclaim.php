<?php
/**
 * Main entry point of Proclaim
 *
 * Calls all scripts, sets up environment. All requests are routed to this class.
 *
 * @author Daniel Owens
 */

declare(strict_types = 1);

namespace Proclaim;
const proclaim_debug = 1;

define("LOADER", "core/utilities/Loader.class.php");

require_once (LOADER);
Loader::Register('Core.Main', 'main');
Loader::Register('Core.Utilities', 'utilities');
Loader::Include('Core.Main.App');
Loader::Include('Core.Utilities.Console');
$test = [1,2,3];
Console::PushString(var_export($test, true));
App::init();
Console::Display();