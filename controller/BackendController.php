<?php

class BackendController{

  public function adminPage()
  {
    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
    $postManager = new PostManager();
    $posts = $postManager->getPostsAdmin();
    $removeMessage = isset($_GET['removeMessage']);
    require('view/backend/adminView.php');
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
  public function addPost($title, $content, $brouillon)
  {
    $postManager = new PostManager();

    $addPost = $postManager->addPost($title, $content, $brouillon);

    if ($addPost === false) {
        throw new Exception('Impossible d\'ajouter le billet !');
    }
    else {
        header('Location: index.php?action=adminPage');
    }
  }
  public function writePost()
  {
    $backUrl = "index.php";
    $removeMessage = isset($_GET['removeMessage']);

    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
      $backUrl = "index.php?action=adminPage";
    }

    $titlePost = "";
    $content = "";
    $form = "index.php?action=addPost";

    require('view/backend/addPostView.php');
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

    require('view/backend/adminCommentView.php');
  }
  public function removeComment($id, $postId)
  {
    $commentManager = new CommentManager();
    $postManager = new PostManager();

    $removePost = $commentManager->removeComment($id);
    $post = $postManager->getPost($postId);

    header('Location: index.php?action=adminComment&postId=' . $postId . '&removeMessage=1');
  }
  public function modifView($id)
  {
    $postManager = new PostManager();

    $post = $postManager->getPost($id);

    $backUrl = "index.php";
    $removeMessage = isset($_GET['removeMessage']);

    session_start ();
    if (isset($_SESSION['pseudo']) && isset($_SESSION['password'])) {
      $backUrl = "index.php?action=adminPage";
    }

    $titlePost = $post['title'];
    $content = $post['content'];
    $form = "index.php?action=modifPost&id=" . $id;

    require('view/backend/addPostView.php');
  }
  public function modifPost($content, $title, $id, $brouillon)
  {
    $postManager = new PostManager();

    $modificationPost = $postManager->modifPost($content, $title, $id, $brouillon);

    header('Location: index.php?action=adminPage');
  }
}
