<?php

use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();
$loader->registerDirs(
        array(
            APP_PATH . '/controllers/',
            APP_PATH . '/models/',
            APP_PATH . '/forms/',
        )
)->register();

// Create a DI
$di = new FactoryDefault();

$di->setShared('session', function () {
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();

    return $session;
});

$di->set('cookies', function() {
    $cookies = new Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(false);
    return $cookies;
});

$di->set('flash', function() {
    $flash = new \Phalcon\Flash\Session([
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
    return $flash;
});

/* View */
$di->set("voltService", function ($view, $di) {
    $volt = new Volt($view, $di);
   
    $volt->setOptions(["compiledPath" => "../app/compiled-templates/", "compiledExtension" => ".compiled", 'compileAlways' => true]);

    $compiler = $volt->getCompiler();

    $compiler->addFunction('formatarData', function($data, $exprArgs) use ($compiler) {
        
        $string = $compiler->expression($exprArgs[0]['expr']);
        return ' implode("/", array_reverse(explode("-",explode(" ", '.$string.')[0])))'; 
     
    });
    
    $compiler->addFunction('formatarValor', function($data, $exprArgs) use ($compiler) {
        
        $string = $compiler->expression($exprArgs[0]['expr']);
        return "'R$: '.number_format($string,2)"; 
     
    });
    
    



    return $volt;
}
);

 

// Setting up the view component
$di->set('view', function() {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    $view->setLayoutsDir(APP_PATH . '/views/layouts/');
    $view->registerEngines([".volt" => "voltService"]);

    return $view;
});



// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function() {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
});

$di->set('router', require realpath(APP_PATH . '/config/routes.php'));

// Set the database service
$di->set('db', function() {
    return new DbAdapter(array(
        "host" => "127.0.0.1",
        "username" => "root",
        "password" => "a1b2c3",
        "dbname" => "avaliacao1"
    ));
});

// Handle the request
try {
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
