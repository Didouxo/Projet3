<?php
require 'model/Manager.php';
require 'model/CommentManager.php';
require 'model/PostManager.php';
require 'model/ConnectionManager.php';
require 'model/RemoveManager.php';

require 'controller/FrontendController.php';
require 'controller/BackendController.php';

$frontendController = new FrontendController();
$backendController = new BackendController();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontendController->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontendController->post($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontendController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
       elseif ($_GET['action'] == 'report') {
         if (isset($_GET['id']) && isset($_GET['postId'])) {
           $frontendController->report($_GET['postId'], $_GET['id']);
         }
         else {
             throw new Exception('Tous les champs ne sont pas remplis !');
         }
       }
       elseif ($_GET['action'] == 'connect') {
         $frontendController->connect();
       }
       elseif ($_GET['action'] == 'verifConnection') {
         if (isset($_POST['pseudo']) && isset($_POST['password'])){
           $frontendController->verifConnection($_POST['pseudo'], $_POST['password']);
         }
       }
       elseif ($_GET['action'] == 'adminPage') {
         $backendController->adminPage();
         }
       elseif ($_GET['action'] == 'deconnect') {
         $backendController->deconnect();
         }
        elseif ($_GET['action'] == 'remove') {
           if (isset($_GET['id']) && $_GET['id'] > 0) {
               $backendController->remove($_GET['id']);
             }
           }
         elseif ($_GET['action'] == 'addPost') {
                 if (!empty($_POST['title']) && !empty($_POST['content'])) {
                     $backendController->addPost($_POST['title'], $_POST['content']);
                   }
                   else {
                       throw new Exception('Tous les champs ne sont pas remplis !');
                   }
    }
        elseif ($_GET['action'] == 'writePost') {
          $backendController->writePost();
          }
  }
    else {
        $frontendController->listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
