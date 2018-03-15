<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="navAdmin">
  <a href="index.php?action=writePost" class="btn btn-outline-light">Ajouter un billet</a>
  <a href="index.php?action=adminComment" class="btn btn-outline-light">Gestion des commentaires</a>
  <a href="index.php?action=deconnect" class="btn btn-outline-light">Deconnexion</a>
</div>
<?php $connection = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container">

  <?php echo '<p> Vous êtes connecté </p>' ; ?>
  <?php if ($removeMessage){
    echo '<p> Billet supprimé ! </p>';
  }
  ?>

  <div class="row">
  <?php while ($data = $posts->fetch()) { ?>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <a href="#">Modifier</a> ou <a href="index.php?action=removePost&amp;id=<?= $data['id'] ?>">Supprimer</a>
        <h5 class="card-title"><?= $data['title'] ?></h5>
        <p class="text-muted"><?= $data['creation_date_fr'] ?></p>
        <p class="card-text"><?= substr(nl2br($data['content']), 0, 100); ?>...</p>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
