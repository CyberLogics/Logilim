<?php

//$_SERVER['LOGILIM_ENV'] = 'production';

defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define("DOCROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);
define("VENDOR_PATH",getcwd().'/vendor');
// Partial
define("QUEUE_PREFIX","queue");
define("WAIT_FOR_ASAP",90);
define("WAIT_FOR_FUTURE",120);
define("STABLE_API_VERSION",'v1.2');


set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH."StickORM"),
    get_include_path(),
)));
require_once 'StickORM/Zend/Loader/Autoloader.php';
require 'Slim/Slim.php';
require_once 'Logilim/Autoloader.php';
require 'StickORM/Autoloader.php';
require_once(VENDOR_PATH.DS.'predis'.DS.'autoload.php');
require_once(VENDOR_PATH.DS.'/KLogger/KLogger.php');
// Slim Loader
\Slim\Slim::registerAutoloader();

// Logilim Loader
\Logilim\Autoloader::registrar();

\StickORM\Autoloader::registerLoader();

if(!defined('STDIN'))
    require_once 'config/config.php';

function api_url($alias) {
    //return HAPPY_URL.'/'.$alias;
    return '/api/'.$alias;
}

function buildDoc($blocks) {

    if(defined('STDIN') )  {
        echo "Are you sure you want to generate the documentation?  Type 'yes' to continue: "."\n";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) != 'yes'){
            echo "ABORTING!\n";
            exit;
        }

        $html = '';
        echo 'Building html..'."\n";
        $html = '<html>
					<head>	

					<title>Fare Dodger Documentation.</title>

					<style type="text/css">

					table{max-width: 100%; background-color: transparent;}

						.table {width: 100%;margin-bottom: 20px;}

						.table th,.table td {padding: 8px;line-height: 20px;text-align: left;vertical-align: top;border-top: 1px solid #dddddd;}

						.table th{font-weight: bold;}

						.table thead th {vertical-align: bottom;}

						.table caption + thead tr:first-child th,.table caption + thead tr:first-child td,.table colgroup + thead tr:first-child th,

						.table colgroup + thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td {border-top: 0;}

						.table tbody + tbody { border-top: 2px solid #dddddd;}

						.table .table { background-color: #ffffff;}

						.table-condensed th,.table-condensed td { padding: 4px 5px;}

						.table-bordered { border: 1px solid #dddddd;border-collapse: separate; *border-collapse: collapse;border-left: 0;-webkit-border-radius: 4px;-moz-border-radius: 4px;

						border-radius: 4px;}

						.well {min-height: 20px;padding: 19px;margin:20px 0;background-color: #f5f5f5;font-weight:700;border: 1px solid #e3e3e3;-webkit-border-radius: 4px;-moz-border-radius: 4px;

border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);}

					</style>

					</head><body><div class="well">Fare Dodger WS Docummentation.</div>

					<table class="table table-condensed">';

        echo 'Builded html..'."\n";

        echo 'Preparing Iteration..'."\n";
		$i = 0;
		foreach ($blocks as $block) {
			$i++;
			$html .= '<tr>';
				$html .= "<td colspan='2' style='background-color: #000; color: #fff;'>{$i}. {$block->desc}</td>";//Getting Description
            $html .= '</tr>';

            foreach ($block->tags as $key => $tag) {

                $html .= '<tr>';

                $tag = array_shift($tag);

                $html .= "<td>{$key}</td>";//Getting Description

                $html .= "<td>{$tag}</td>";//Getting Description

                $html .= '</tr>';

            }

		}
        echo 'Iteration completed..'."\n";

		$html .= '</table></body></html>';
        file_put_contents('fddb.html',$html);
        echo 'Cooked the HTML..'."\n";

        echo 'Your FarDodgers Documentation Builder did his job. Find out "fddb.html" in current directory.'."\n";

        echo 'Thank You!. Author - Muhammad Ibrahim'."\n";
	}

}

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();