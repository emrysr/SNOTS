<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \PDO as PDO;

require dirname(__DIR__) . '/vendor/autoload.php';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


$db = new PDO('sqlite:'.dirname(__DIR__) . '/db/test.db');

//-----------------
// SLIM
$c = new \Slim\Container(); //Create Your container
$settings = $c->get('settings');
$settings->replace([
    'displayErrorDetails' => true,
    'logger' => [
        'name' => 'skel-app',
        'level' => Monolog\Logger::DEBUG,
        'path' => __DIR__ . '/../logs/app.log',
    ]
]);

//Override the default Not Found Handler before creating App
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write('Page not found');
    };
};
$app = new \Slim\App($c);


//-----------------
// TWIG TEMPLATES
// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(dirname(__DIR__) . '/views', [
        'cache' => dirname(__DIR__) . '/cache',
        'debug' => true
    ]);
    // global template variables
    $view->getEnvironment()->addGlobal("current_path", $container["request"]->getUri()->getPath());
    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};



//ROUTES
//-----------------

$app->get('/', function (Request $request, Response $response, array $args) use ($db) {
    $query = "SELECT timestamp,url,count(*) as total FROM likes GROUP BY url";
    return $this->view->render($response, 'home.html.twig',[
        'rows'=>$db->query($query),
        'title'=>'list'
    ]);
})->setName('home');

$app->get('/likes', function (Request $request, Response $response, array $args) use ($db) {
    $query = "SELECT timestamp,url,count(*) as total FROM likes GROUP BY url";
    $sth = $db->prepare($query);
    $sth->execute();

    return $response->withJson([
        'data'=> [
            'likes' => $sth->fetchAll(PDO::FETCH_ASSOC)
        ]
    ]);
});

$app->post('/likes', function(Request $request, Response $response, array $args) use ($db) {
    $time = time();
    $rating = intval(rand(1,5));
    $url = $_REQUEST['url'];
    $insert = sprintf("INSERT INTO likes (url) VALUES ('%s')",$url);
    $dbResponse = $db->query($insert);
    if(!$dbResponse) {
        return $response->withJson(["error" => $db->errorInfo()],500);
    }
    return $response->withJson([
        'data'=> [
            'last-inserted'=>$db->lastInsertId()
        ]
    ], 200);
});


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