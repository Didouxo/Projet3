<?php

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, brouillon, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE brouillon = 0 ORDER BY creation_date DESC LIMIT 0, 6');

        return $req;
    }

    public function getPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }
    public function addPost($title, $content, $brouillon)
    {
      $db = $this->dbConnect();
      $addPost = $db->prepare('INSERT INTO posts(title, content, brouillon, creation_date) VALUES(?, ?, ?, NOW())');
      $addPost->execute(array($title, $content, $brouillon));

      return $addPost;
    }
    public function removePost($id)
    {
      $db = $this->dbConnect();
      $req = $db->prepare('DELETE FROM posts WHERE id = ?');
      $req->execute(array($id));
    }
    public function modifPost($content, $title, $id, $brouillon)
    {
      $db = $this->dbconnect();
      $comments = $db->prepare('UPDATE posts SET content = ?, title = ?, brouillon = ? WHERE id = ?');
      $comments->execute(array($content, $title, $brouillon, $id));

      return $comments;
    }
    public function getPostsAdmin()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, brouillon, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 6');

        return $req;
    }
}
