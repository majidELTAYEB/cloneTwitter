
<?php
use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

// Les variables
define('ROOT_PATH', __DIR__);
define('WWW_PATH', realpath(ROOT_PATH.'/public'));
define('VIEWS',dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS',dirname($_SERVER['SCRIPT_NAME'])."/");
define("BASE_NAME", "/twitter/");
define('requestUrl' , "");

define('DB_NAME','twitter');
define('DB_HOST','localhost');
//define('DB_USER','tenec');
//define('DB_PWD','tene');
// define('DB_USER','root');
// define('DB_PWD',"root");

$router = isset($_GET['url']) ? new Router($_GET['url']) : new Router('/');

// VISITEUR
$router->get('/', 'App\Controllers\PageController@home');
$router->get('/search', 'App\Controllers\SearchController@search');
$router->get('/datasearch', 'App\Controllers\SearchController@datasearch');
$router->post('/theme', 'App\Controllers\SearchController@test');

// $router->get('/:username', 'App\Controllers\UserController@user');
    $router->post('/SendTweet', 'App\Controllers\PageController@SendTweet');
    $router->post('/displayTweets', 'App\Controllers\PageController@displayTweets');

$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/register', 'App\Controllers\UserController@register');
$router->post('/register', 'App\Controllers\UserController@registerPost');
$router->get('/logout', 'App\Controllers\UserController@logout');

// Notications
$router->get('/notifications', 'App\Controllers\NoticationsController@index');
// Display
$router->get('/display', 'App\Controllers\PageController@display');

$router->get('/:username', 'App\Controllers\UserController@userProfile');
$router->get('/:username/followers', 'App\Controllers\UserController@followers');
$router->get('profile/edit', 'App\Controllers\UserController@edit');
$router->post('profile/edit', 'App\Controllers\UserController@editPost');
$router->get('/logout', 'App\Controllers\UserController@logout');

try{
    $router->run();
}
catch(NotFoundException $e){
  $exep = new NotFoundException();
  $exep->error404();
}

