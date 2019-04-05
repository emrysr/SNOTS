<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \PDO as PDO;

require dirname(__DIR__) . '/vendor/autoload.php';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

// Start PHP session
session_start(); //by default requires session storage

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



// GET CONTAINER
//-----------------
$container = $app->getContainer();


//-----------------
// FLASH MESSAGES
// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

//-----------------
// TWIG TEMPLATES

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
$base64_filter = new Twig_SimpleFilter('base64', function ($string) {
    return base64_encode($string);
});
$container->get('view')->getEnvironment()->addFilter($base64_filter);

//ROUTES
//-----------------

$app->get('/', function (Request $request, Response $response, array $args) use ($db) {
    $query = "SELECT timestamp,url,count(*) as total FROM likes GROUP BY url";
    $sth = $db->prepare($query);
    $sth->execute();

    return $this->view->render($response, 'home.html.twig', [
        'urls' => $sth->fetchAll(PDO::FETCH_ASSOC),
        'title' =>'list',
        'messages' => $this->flash->getMessages()
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
// base64 encoded url passed as parameter to get detail on individual urls
$app->get('/likes/{url:(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=)?}', function (Request $request, Response $response, array $args) use ($db) {
    if ($url = base64_decode($args['url'], true)) {
        $query = sprintf("SELECT timestamp as latest,url,count(*) as likes FROM likes WHERE url = '%s' GROUP BY url ORDER BY latest DESC", $url);
        $sth = $db->prepare($query);
        $sth->execute();
        $likes = $sth->fetchAll(PDO::FETCH_ASSOC);
        // if found return JSON object
        if (count($likes) === 1) {
            return $response->withJson([
                'data'=> [
                    'likes' => $likes
                ]
            ]);
        } else {
            $this->flash->addMessage('danger', 'Not Found');
        }
    }
    // redirect to home if passed url not decoded correctly or if record not found
    return $response->withStatus(302)->withHeader('Location', $this->get('router')->pathFor('home'));
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

$app->delete('/likes', function(Request $request, Response $response, array $args) use ($db) {
    if ($url = base64_decode($args['url'], true)) {
        $query = sprintf("SELECT FROM likes where url = '%s'", $url);
        $sth = $db->prepare($query);
        $sth->execute();

        if ($sth->rowCount() > 0) {
            return $response->withJson([
                'data'=> [
                    'deleted'=>$url
                ]
            ], 200);
        }
    }
    return $response->withJson([
        'data'=> [
            'success' => false,
            'message' => sprintf('%s not deleted',$url)
        ]
    ], 400);
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