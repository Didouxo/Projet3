<?php $title = htmlspecialchars($post['title']); ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<div class="container">
<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>

<?php if ($reportMessage){
  echo '<p class=" alert alert-block alert-success"> Signalé ! </p>';
}
?>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>

    <p class="billet">
        <?= nl2br($post['content']) ?>
    </p>
</div>

<h2>Commentaires</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

<?php
while ($comment = $comments->fetch())
{
?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <a href="index.php?action=report&id=<?= $comment['id']?>&postId=<?= $comment['post_id']?>">Signaler</a>
<?php
}
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
