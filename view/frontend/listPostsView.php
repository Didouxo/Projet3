<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<div class="jumbotron" "row">
  <h1 class="d-flex justify-content-center">Un billet simple pour l'alaska !</h1>
  <img class="col-sm-12" src="public/images/alaska.jpeg" alt="photo de l'alaska">
</div>

  <div class="container">
    <div class="row">
    <?php while ($data = $posts->fetch()) { ?>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($data['title']) ?></h5>
          <p class="text-muted"><?= $data['creation_date_fr'] ?></p>
          <p class="card-text"><?= substr(nl2br(htmlspecialchars($data['content'])), 0, 100); ?>...</p>
          <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Lire l'article</a>
        </div>
      </div>
    </div>
    <?php } ?>
    </div>
  </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
