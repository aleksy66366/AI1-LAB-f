<?php
// src/Controller/CommentController.php

namespace App\Controller;

use PDO;
use App\Model\Comment;
use App\Service\Templating;
use App\Service\Router;


class CommentController
{
    private $commentModel;

    private $templating;
    private $router;

    public function __construct()
    {
        // przy założeniu, że masz dostęp do obiektu PDO w ten sposób
        $pdo = new PDO('sqlite:C:/Users/aleks/Desktop/sem_5/AI/tmp 6/custom-php-framework/identifier.sqlite');
        $this->commentModel = new Comment($pdo);
        $this->templating = new Templating();
        $this->router = new Router();
    }

    public function indexAction()
    {
        $comments = $this->commentModel->findAll();
        return $this->templating->render('comments/index.html.php', ['comments' => $comments]);
    }

    public function createAction($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->commentModel->save($data['postId'], $data['author'], $data['content']);
            $this->router->redirect('/comments');
        }

        return $this->templating->render('comments/create.html.php');
    }

    public function editAction($id, $data)
    {
        $comment = $this->commentModel->findById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->commentModel->update($id, $data['content']);
            $this->router->redirect('/comments');
        }

        return $this->templating->render('comments/edit.html.php', ['comment' => $comment]);
    }

    public function showAction($id)
    {
        $comment = $this->commentModel->findById($id);
        return $this->templating->render('comments/show.html.php', ['comment' => $comment]);
    }

    public function deleteAction($id)
    {
        $this->commentModel->delete($id);
        $this->router->redirect('/comments');
    }
}
