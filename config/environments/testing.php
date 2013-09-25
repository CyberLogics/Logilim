<?php
define("AMQP_HOST","mqx.faredodgers.com");
define("AMQP_LOGIN","guest");
define("AMQP_PASS","guest");
define("AMQP_PORT",5672); // Already working :s
//define("AMQP_PORT",15672); // Already working :s
define("AMQP_VHOST","mqx.faredodgers.com");
define("FD_RABBIT_DRIVER_EXCHANGE","FareDodgersDriverExchange");
define("FD_RABBIT_USER_EXCHANGE","FareDodgersUserExchange");
define("FD_RABBIT_TYPE_BIDS",1);
define("FD_RABBIT_TYPE_JOBS",2);

global $database, $redis;
$database = array(
    'enable_m/s'    => false,
    'default'   => array(
        'host'      => 'www.testing.com',
        'username'  => 'root',
        'password'  => 'root',
        'dbname'    =>  'faredodgers_v1'
    ),
    'master'    => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => 'root',
        'dbname'    =>  'faredodgers_v1'
    ),
    'slave'     => array(
        'host'      => 'localhost',
        'username'  => 'root',
        'password'  => 'root',
        'dbname'    =>  'faredodgers_v1'
    )
);
$redis = new Predis\Client();