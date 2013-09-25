<?php

/**
 * This is the entry point of the application
 *
 * @author  Hamza Waqas <hamza.waqas@logicait.pk>
 * @version GIT: 54de73ec046156526cfd35a0a48fcca066aadcac
 * @since   16th September, 2013
 */
require_once 'bootstrap.php';



error_reporting(E_ALL);

$app->notFound(function() use ($app) {
    $app->halt(404,"Seems, you missed HTTP method or forming a wrong url!");
});



if(!defined('STDIN'))
    $app->add(new OXMiddleware());


$app->router()
    ->addRoute(new \Logilim\Routes\RootRoute())
    ->addRoute(new \Logilim\Routes\UserLoginRoute())
    ->addRoute(new \Logilim\Routes\UserRegistrationRoute())
    ->addRoute(new \Logilim\Routes\UserUpdateRoute())
    ->addRoute(new \Logilim\Routes\UserProfileRoute())
    ->addRoute(new \Logilim\Routes\DriverReviewRoute())
    ->addRoute(new \Logilim\Routes\NewJobRoute())
    ->addRoute(new \Logilim\Routes\ConfirmJobRoute())
    ->addRoute(new \Logilim\Routes\JobCompletedRoute())
    ->addRoute(new \Logilim\Routes\JobReviewRoute())
    ->addRoute(new \Logilim\Routes\NewBidRoute())
    ->addRoute(new \Logilim\Routes\BidAcceptRoute())
    ->addRoute(new \Logilim\Routes\BidRefuseRoute())
    ->addRoute(new \Logilim\Routes\GetBidsRoute())
    ->addRoute(new \Logilim\Routes\UpdateJobRoute())
    ->addRoute(new \Logilim\Routes\TokenRefreshRoute())
    ->addRoute(new \Logilim\Routes\UserForgotRoute());


/***************************************************************************************/



/**
 *  Don't touch it. Else things won't work! ;)
 */

$app->run();

$routes = $app->router()->getAllRoute();
require ('doc-block-parser.php');
$blocks = array();

foreach ($routes as $route) {
    $blocks[] = DocBlock::ofClass($route);
}
buildDoc($blocks);