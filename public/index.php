<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();

$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$pdo = new PDO('sqlite:C:/Users/aleks/Desktop/sem_5/AI/tmp 6/custom-php-framework/identifier.sqlite');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$action = $_REQUEST['action'] ?? null;
switch ($action) {
    case 'post-index':
    case null:
        $controller = new \App\Controller\PostController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'post-create':
        $controller = new \App\Controller\PostController();
        $view = $controller->createAction($_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-edit':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['post'] ?? null, $templating, $router);
        break;
    case 'post-show':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->showAction($_REQUEST['id'], $templating, $router);
        break;
    case 'post-delete':
        if (! $_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\PostController();
        $view = $controller->deleteAction($_REQUEST['id'], $router);
        break;
    case 'info':
        $controller = new \App\Controller\InfoController();
        $view = $controller->infoAction();
        break;
    case 'comment-index':
        $controller = new \App\Controller\CommentController($pdo);
        $view = $controller->indexAction();
        break;
    case 'comment-create':
        $controller = new \App\Controller\CommentController($pdo);
        $view = $controller->createAction($_REQUEST['comment'] ?? null);
        break;
    case 'comment-edit':
        if (!$_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CommentController($pdo);
        $view = $controller->editAction($_REQUEST['id'], $_REQUEST['comment'] ?? null);
        break;
    case 'comment-show':
        if (!$_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CommentController($pdo);
        $view = $controller->showAction($_REQUEST['id']);
        break;
    case 'comment-delete':
        if (!$_REQUEST['id']) {
            break;
        }
        $controller = new \App\Controller\CommentController($pdo);
        $view = $controller->deleteAction($_REQUEST['id']);
        break;
    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
