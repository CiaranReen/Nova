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

require 'Nova/Constants.php';
require 'Nova/Database/Db.php';
require 'Nova/Nova.php';

require 'Nova/Bootstrap.php';
require 'Nova/Controllers/NovaBaseController.php';
require 'Nova/Views/NovaBaseView.php';
require 'Nova/Models/NovaBaseModel.php';
require 'Nova/Forms/NovaBaseForm.php';
require 'Nova/Session/NovaSession.php';
require 'vendor/autoload.php';

//Run the application!
$app = new Bootstrap();