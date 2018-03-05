<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<a href="index.php?action=deconnect" class="btn btn-outline-light">Deconnexion</a>
<?php $connection = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container">
  <?php echo '<p> Vous êtes connecté </p>' ; ?>
  <?php if ($removeMessage){
    echo '<p> Supprimé ! </p>';
  }
  ?>
  <div class="row">
  <?php while ($data = $posts->fetch()) { ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <a href="#">Modifier</a> ou <a href="index.php?action=remove&amp;id=<?= $data['id'] ?>">Supprimer</a>
        <h5 class="card-title"><?= htmlspecialchars($data['title']) ?></h5>
        <p class="text-muted"><?= $data['creation_date_fr'] ?></p>
        <p class="card-text"><?= substr(nl2br(htmlspecialchars($data['content'])), 0, 100); ?>...</p>
        <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary" style="background-color:#255681;">Lire l'article</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
