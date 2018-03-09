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
  public function remove($id)
  {
    $removeManager = new RemoveManager();

    $removePost = $removeManager->remove($id);

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
}
