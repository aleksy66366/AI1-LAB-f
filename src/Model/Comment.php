<?php
// src/Model/Comment.php

namespace App\Model;
use PDO;

class Comment
{
    private $pdo;
    public $id;
    public $postId;
    public $author;
    public $content;
    public $createdAt;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $stmt = $this->pdo->query('SELECT * FROM comments');
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM comments WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function save($postId, $author, $content)
    {
        $stmt = $this->pdo->prepare('INSERT INTO comments (postId, author, content) VALUES (?, ?, ?)');
        $stmt->execute([$postId, $author, $content]);
        $this->id = $this->pdo->lastInsertId();
    }

    public function update($id, $content)
    {
        $stmt = $this->pdo->prepare('UPDATE comments SET content = ? WHERE id = ?');
        $stmt->execute([$content, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM comments WHERE id = ?');
        $stmt->execute([$id]);
    }
}
