<?php

class ConnectionManager extends Manager
{
  public function verifConnection($pseudo, $password)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('SELECT id, pseudo, password FROM user WHERE pseudo = ?');
    $req->execute(array($pseudo));
    $user = $req->fetch();
    if ($user) {
      return sha1($password) == $user['password'];
    }
    return false;
  }
}
