<?php
$routes = new Routes();
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you map URI requests to specific controllers
| Pass in through 2 params, the URI and then the relative controller path
|
| For example, $routes->set('/index/', 'app/controllers/default/Welcome');
*/


$routes->set('/admin/', 'app/controllers/admin/Admin');
$routes->set('/admin/courses/', 'app/controllers/admin/Courses');