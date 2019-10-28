<?php
include ROOTPATH.DIRECTORY_SEPARATOR.'App'.DIRECTORY_SEPARATOR.'Db.php';
class App

{
        
    public static $router;
    
    public static $db;
    
    public static $kernel;
    
    public static function init()
    {
        spl_autoload_register(['static','loadClass']);
        static::bootstrap();
        set_exception_handler(['App','handleException']);
        
    }
    
    public static function bootstrap()
    {
        static::$router = new App\Router();
        static::$kernel = new App\Kernel();
        static::$db = new Db();
    }
    
    public static function loadClass ($className)
    {
        
        $className =  str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH.DIRECTORY_SEPARATOR.$className.'.php';
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'Users.php';
        require_once ROOTPATH.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR.'Tasks.php';
        
    }
    
    public function handleException (Throwable $e)
    {
        
        if($e instanceof \App\Exceptions\InvalidRouteException) {
            echo static::$kernel->launchAction('Error', 'error404', [$e]);
        }else{
            echo static::$kernel->launchAction('Error', 'error500', [$e]);  
        }
        
    }
    
}