<?php

class FrontendController{

  public function listPosts()
  {
      $postManager = new PostManager();
      $posts = $postManager->getPosts();

      require('view/frontend/listPostsView.php');
  }

  public function post()
  {
      $postManager = new PostManager();
      $commentManager = new CommentManager();

      $post = $postManager->getPost($_GET['id']);
      $comments = $commentManager->getComments($_GET['id']);

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
}
