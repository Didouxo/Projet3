<?php

class BackendController{

  public function adminPage()
  {
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/frontend/verificationView.php');
  }

}
