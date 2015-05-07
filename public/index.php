<?php 
require dirname(__DIR__) . '/vendor/autoload.php';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//SLIM

$app = new \Slim\Slim(array(
	'mode' => 'development',
    'view' => new \Slim\Views\Twig(),
    'templates.path' => dirname(__DIR__) . '/views'
));

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,	
        'debug' => true
    ));
});



//NOTORM

try {
    // Connect to the SQLite Database.
    $pdo = new PDO('sqlite:'.dirname(__DIR__) . '/db/test.db');
    $db = new NotORM($pdo);
    
} catch(Exception $e) {
    die('connection_unsuccessful: ' . $e->getMessage());
}


//TWIG


$twig = $app->view();

$twig->parserOptions = array(
    'debug' => true,
    'cache' => dirname(__DIR__) . '/cache'
);
$twig->parserExtensions = array(
    new \Slim\Views\TwigExtension()
);




//ROUTES
//-----------------


$app->notFound(function () use ($app){
	$req = $app->request();
	echo '404 '.$req->getPath();
});

$app->get('/', function () use ($app) {
    $app->render('home.html.twig');
})->name('dash');




$app->run();



/*
$loader = new Twig_Loader_Filesystem('/var/www/sandbox/sqlite/views');
$twig = new Twig_Environment($loader, array(
	'auto_reload'=>true,
    'cache' => '/var/www/sandbox/sqlite/cache',
));

$_data['page_title'] = 'SQLite SANDBOX';
$_data['title'] = 'Testing... 1,2,3... testing';

echo $twig->render('home.html.twig',$_data);


*/
?>