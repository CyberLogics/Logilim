    <?php
/**
 * Created as config.php.
 * Developer: Hamza Waqas
 * Date:      5/20/13
 * Time:      4:26 PM
 */

try {
    global $deprecated_apis, $logger;
    $deprecated_apis = array(
        'v0.1',
        'v0.2',
        'v0.3',
        'v0.4',
        'v0.5',
        'v1.0',
        'v1.1'
    );
    loadEnvironmentSupportConfiguration();
    $logger = new KLogger(DOCROOT.DS.'temp',KLogger::INFO);

    /**
     * @TODO    Add support for loading master / slave.
     * @TODO    Disable Profiler
     */

    try{
        //Needs code modification. Before this change the second parameter passed to factory method was $database.
        //it had problem in the connection part so temporarily i made this change

        StickConfig::getInstance()->datasource = new Database(Zend_Db::factory('Pdo_Mysql', $database));
    }catch (Exception $ex){
        echo '<pre>';
        print_r($ex);
    }
   // echo "<pre>"; print_r(StickConfig::getInstance()->datasource); exit;

} catch (Exception $ex) {
    $logger->logError('Unable to Connect Database: '. $ex->getMessage());
}

function loadEnvironmentSupportConfiguration() {

    if ( ! array_key_exists('LOGILIM_ENV', $_SERVER))
        throw new Exception("Seems, you didn't configured LOGILIM_ENV in your .htaccess");

    $env = $_SERVER['LOGILIM_ENV'];
    if ( $env == 'development') {
        require_once 'environments/development.php';
    } else
    if ( $env == 'testing') {
        require_once 'environments/testing.php';
    } else
    if ( $env == 'stagging') {
        require_once 'environments/stagging.php';
    } else
    if ( $env == 'production') {
        require_once 'environments/production.php';
    }
}