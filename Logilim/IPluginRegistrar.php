<?php
/**
 * Created as IPluginRegistrar.php.
 * Developer: Hamza Waqas
 * Date:      2/26/13
 * Time:      4:00 PM
 */

namespace Logilim;

interface IPluginRegistrar {
     public static function addPlugin(Plugin $plugin);
     public static function addPlugins(array $plugins);
     public static function removePlugin($name);
     public static function getPlugin($name);
     public static function getPlugins();
     public static function hasPlugin($name);

}
