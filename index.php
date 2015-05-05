<?php 
require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


try {
    // Connect to the SQLite Database.
    $db = new PDO('sqlite:db/test.db');
} catch(Exception $e) {
    die('connection_unsuccessful: ' . $e->getMessage());
}

$loader = new Twig_Loader_Filesystem('/var/www/sandbox/sqlite/views');
$twig = new Twig_Environment($loader, array(
	'auto_reload'=>true,
    'cache' => '/var/www/sandbox/sqlite/cache',
));

$_data['page_title'] = 'SQLite SANDBOX';
$_data['title'] = 'Testing... 1,2,3... testing';

echo $twig->render('home.html.twig',$_data);

?>