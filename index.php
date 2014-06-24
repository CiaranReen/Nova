<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:33
 */

//Set error reporting based on the current environment superglobal
switch ($_SERVER['ENVIRONMENT'])
{
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 'On');
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit();
}

// PHP version must be 5.2 or greater
if(version_compare(phpversion(), "5.2.0", "<")) {
    exit("<b>Fatal Error:</b> PHP version must be 5.2.0 or greater to run Nova.");
}

require 'lib/Nova/Error.php';
$error = new Error();

require 'lib/Nova/Constants.php';
require 'lib/Nova/Hash.php';
require 'lib/Nova/Pagination.php';
require 'lib/Nova/Database/Db.php';
require 'lib/Nova/Routes.php';


require 'app/config/routes.php';

require 'lib/Nova/Database/Solace.php';
require 'lib/Nova/Database/Db_Benchmark.php';
require 'lib/Nova/Nova.php';

require 'lib/Nova/Controllers/NovaBaseController.php';
require 'lib/Nova/Views/NovaBaseView.php';
require 'lib/Nova/Models/NovaBaseModel.php';
require 'lib/Nova/Forms/NovaBaseForm.php';
require 'lib/Nova/Session/NovaSession.php';

require 'vendor/autoload.php';

//Run the application!
$app = new Nova();
$app->run($routes->getRoutes());