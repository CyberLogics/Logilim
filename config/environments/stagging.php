<?php

define("AMQP_HOST","mqx.faredodgers.com");
define("AMQP_LOGIN","guest");
define("AMQP_PASS","guest");
define("AMQP_PORT",5672); // Already working :s
define("AMQP_VHOST","mqx.faredodgers.com");
define("FD_RABBIT_DRIVER_EXCHANGE","FareDodgersDriverExchange");
define("FD_RABBIT_USER_EXCHANGE","FareDodgersUserExchange");
define("FD_RABBIT_TYPE_BIDS",1);
define("FD_RABBIT_TYPE_JOBS",2);

global $database, $redis;
$database = array(
    'driver_options' => array(PDO::ATTR_TIMEOUT=>5),
    'host'           => 'localhost',
    'username'       => 'hamza',
    'password'       => 'hmz702',
    'dbname'         => 'faredodgers_v1',
    'profiler'      => false,
    'master_servers' => 1,
    'servers'        => array(
        array('host' => 'localhost'),   // Master
        array('host' => 'localhost'),   // Slave
        array('host' => 'localhost')    // Slave
    )
);


$redis = new Predis\Client(array(
    'database'  => 0
));