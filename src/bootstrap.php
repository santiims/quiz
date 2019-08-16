

<?php

use Illuminate\Database\Capsule\Manager as Capsule;

//Globals
define('DS', DIRECTORY_SEPARATOR);
define('VIEW_BASE_FOLDER', __DIR__ . DS . 'views');
define('TEMPLATE_BASE_FOLDER', __DIR__ . DS . 'templates');

//Database
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'quizzes',
    'username'  => 'homestead',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',

]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

