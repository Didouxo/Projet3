<?php
require 'model/Manager.php';
require 'model/CommentManager.php';
require 'model/PostManager.php';

require 'controler/FrontendController.php';

$frontendController = new FrontendController();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontendController->listPosts();
        }
        elseif ($_GET['action'] == 'article') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $frontendController->article($_GET['id']);
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
    }
    else {
        $frontendController->listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
