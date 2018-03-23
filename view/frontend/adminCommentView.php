<?php $title = 'Commentaires' ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<div class="container">
<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>
<?php if ($removeMessage){
  echo '<p class="alert alert-block alert-danger"> Commentaire supprimé ! </p>';
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
    <p class="alert alert-block alert-warning">Ce commentaire a été signalé <strong><?= $comment['report'] ?> fois.</strong></p>
    <p><a href="index.php?action=removeComment&amp;id=<?= $comment['id'] ?>">Supprimé</a> ou <a href="#">Approuvé</a></p>
  </div>
<?php
}
?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
