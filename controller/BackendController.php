<?php

class BackendController{

  public function adminPage()
  {
    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    $removeMessage = isset($_GET['removeMessage']);
    require('view/frontend/adminView.php');
    }
    else {
      header ('location: index.php?action=connect');
    }
  }
  public function deconnect()
  {
session_start ();

session_unset ();

session_destroy ();

header ('location: index.php');
  }
  public function removePost($id)
  {
    $postManager = new PostManager();

    $removePost = $postManager->removePost($id);

    header('Location: index.php?action=adminPage&removeMessage=1');
  }
  public function addPost($title, $content)
  {
    $postManager = new PostManager();

    $addPost = $postManager->addPost($title, $content);

    if ($addPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?action=adminPage');
    }
  }
  public function writePost()
  {
    require('view/frontend/addPostView.php');
  }
  public function adminComment()
  {
    $commentManager = new CommentManager();

    $comments = $commentManager->getCommentsReport();
    $backUrl = "index.php";
    $removeMessage = isset($_GET['removeMessage']);

    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
      $backUrl = "index.php?action=adminPage";
    }

    require('view/frontend/adminCommentView.php');
  }
  public function removeComment($id, $postId)
  {
    $commentManager = new CommentManager();
    $postManager = new PostManager();

    $removePost = $commentManager->removeComment($id);
    $post = $postManager->getPost($postId);

    header('Location: index.php?action=adminComment&postId=' . $postId . '&removeMessage=1');

  }
}
