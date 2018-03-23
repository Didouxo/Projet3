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
      $backUrl = "index.php";
      $reportMessage = isset($_GET['reportMessage']);

      session_start ();
      if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
        $backUrl = "index.php?action=adminPage";
      }

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

    header('Location: index.php?action=post&id=' . $postId . '&reportMessage=1');
  }
  public function connect()
  {

    $backUrl = "index.php";
    $removeMessage = isset($_GET['removeMessage']);

    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
      $backUrl = "index.php?action=adminPage";
    }

    $error = isset($_GET['error']);

    require('view/frontend/connectionView.php');
  }
  public function verifConnection($pseudo, $password)
  {
    $connectionManager = new ConnectionManager();

    $exist = $connectionManager->verifConnection($pseudo, $password);
    if (isset($_POST['pseudo']) && isset($_POST['password'])) {

    	if ($exist) {

    		session_start ();
    		$_SESSION['pseudo'] = $_POST['pseudo'];
    		$_SESSION['password'] = $_POST['password'];

    		header ('Location: index.php?action=adminPage');
    	}
    	else {
    		header ('Location: index.php?action=connect&error=1');
    	}
    }
  }
}
