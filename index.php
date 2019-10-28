<?php
//$path = '/task1';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path);

define('ROOTPATH', __DIR__.'');

require __DIR__.'/App/App.php';
App::init();
App::$kernel->launch();