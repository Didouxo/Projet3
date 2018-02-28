<?php

class FrontendController{

  public function listPosts()
  {
      $postManager = new PostManager();
      $posts = $postManager->getPosts();

      require('view/frontend/listPostsView.php');
  }

  public function post($id)
  {
      $postManager = new PostManager();
      $commentManager = new CommentManager();

      $post = $postManager->getPost($id);
      $comments = $commentManager->getComments($id);

      require('view/frontend/postView.php');
  }

  public function addComment($postId, $author, $comment)
  {
      $commentManager = new CommentManager();

      $affectedLines = $commentManager->postComment($postId, $author, $comment);

      if ($affectedLines === false) {
          throw new Exception('Impossible d\'ajouter le commentaire !');
      }
      else {
          header('Location: index.php?action=post&id=' . $postId);
      }
  }
  public function report($postId, $id)
  {
    $commentManager = new CommentManager();

    $report = $commentManager->report($id);
    header('Location: index.php?action=post&id=' . $postId);
  }
  public function connect()
  {
    $error = isset($_GET['error']);
    require('view/frontend/connectionView.php');
  }
  public function verifConnection($pseudo, $password)
  {
    $connectionManager = new ConnectionManager();

    $verifConnection = $connectionManager->verifConnection($pseudo, $password);
    if ($verifConnection){
      header('Location: index.php?action=adminPage');
    }
    else {
      header('Location: index.php?action=connect&error=1');
    }
  }
}
