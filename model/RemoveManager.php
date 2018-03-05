<?php

class RemoveManager extends Manager
{
  public function remove($id)
  {
    $db = $this->dbConnect();
    $req = $db->prepare('DELETE FROM posts WHERE id = ?');
    $req->execute(array($id));
  }
}
