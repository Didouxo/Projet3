<?php

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, report, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, report, comment_date) VALUES(?, ?, ?, 0, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function report($id)
    {
      $db = $this->dbconnect();
      $comments = $db->prepare('UPDATE comments SET report = report + 1 WHERE id=:id');
      $comments->execute(array(
        "id" => $id
      ));
    }

    public function getCommentsReport()
    {
        $db = $this->dbConnect();
        $comments = $db->query('SELECT id, author, comment, report, post_id, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY report DESC, comment_date');
        return $comments;
    }
    public function removeComment($id)
    {
      $db = $this->dbConnect();
      $req = $db->prepare('DELETE FROM comments WHERE id = ?');
      $req->execute(array($id));
    }
}
