<?php $title = 'Commentaires' ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<div class="container">
<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>
<?php if ($removeMessage){
  echo '<p class="alert alert-block alert-success"> Commentaire supprimé ! </p>';
}
?>

<h2>Commentaires</h2>

<?php
while ($comment = $comments->fetch())
{
?>
  <div class="card">
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <p><strong>Ce commentaire a été signalé <?= $comment['report'] ?> fois.</strong></p>
    <p><a href="index.php?action=removeComment&amp;id=<?= $comment['id'] ?>">Supprimé</a></p>
  </div>
<?php
}
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
