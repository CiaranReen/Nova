<?php
/**
 * Created by PhpStorm.
 * User: ciaran
 * Date: 27/05/14
 * Time: 11:33
 */

require 'Go/Bootstrap.php';
require 'config/connection.php';
require 'Go/Database/GoDatabase.php';
require 'Go/Controllers/GoBaseController.php';
require 'Go/Views/GoBaseView.php';
require 'Go/Models/GoBaseModel.php';
require 'Go/Session/GoSession.php';

$app = new Bootstrap();
