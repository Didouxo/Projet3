<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<a href="index.php?action=connect" class="btn btn-outline-light">Connexion</a>
<?php $connection = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="jumbotron" "row">
  <h1 class="d-flex justify-content-center">Un billet simple pour l'alaska !</h1>
  <img class="col-sm-12" src="public/images/alaska.jpeg" alt="photo de l'alaska">
</div>

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
    <div class="row">
    <?php while ($data = $posts->fetch()) { ?>
      <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($data['title']) ?></h5>
          <p class="text-muted"><?= $data['creation_date_fr'] ?></p>
          <p class="card-text"><?= substr(nl2br($data['content']), 0, 100); ?></p>
          <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary" style="background-color:#255681;">Lire l'article</a>
        </div>
      </div>
    </div>
    <?php } ?>
    </div>
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <img class="profilpic" src="public/images/ecrivain.jpeg" alt="photo de l'écrivain">
          <p class="biographie">Bonjour, je suis Jean Forteroche, ravie de faire votre connaissance ! Peut-être ne m'avez vous jamais lue ? C'est le moment de faire un tour au fil des pages de ce site/blog et de découvrir mon roman "Un billet simple pour l'alaska".</br></br> Hello, I'm Jean Forteroche, happy to meet you! Perhaps you have never read me? This is the time to take a tour through the pages of this site / blog and discover my novel "A simple ticket for Alaska."</p>
        </div>
      </div>
    </div>
  </div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
