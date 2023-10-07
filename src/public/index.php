<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$db = new PDO("mysql:host=db;dbname=" . $_ENV['MYSQL_DATABASE'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);

$twig = Twig::create('../templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', function (Request $request, Response $response, $args) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.html');
})->setName('home');

$app->get('/search', function(Request $request, Response $response, $args){
    $view = Twig::fromRequest($request);
    return $view->render($response, 'search.html');
})->setName('search');

$app->get('/list.json', function(Request $request, Response $response){
    $params = $request->getQueryParams();
    $param_encode = urlencode($params['q']);
    $json = file_get_contents("https://www.mediawiki.org/w/api.php?action=opensearch&search=" . $param_encode);
    $data = json_decode($json);
    return $response->withJson($data[1]);
})->setName('list');

$app->post('/term/create', function(Request $request, Response $response) use ($db){
    if($request->isXhr()) {
        try {
            $term = $request->getParsedBodyParam('term');
            $sql = "INSERT INTO audax_terms (term) VALUES (?)";
            $stmt= $db->prepare($sql);
            $result = $stmt->execute([$term]);
            if($result == true){
                return $response->withJson(['create' => true]);
            }else{
                return $response
                ->withJson(['create' => false]);
            }
        } catch (PDOException $e) {
            return $response->withJson([
                    'create' => false, 
                    'code' => intval($e->getCode()),
                    'message' => $e->getMessage()
                ]
            )
            ->withStatus(400);
        }

    }
})->setName('term.create');

$app->run();