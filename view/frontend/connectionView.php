<?php $title = 'Mon blog'; ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<div class="container">

<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>

  <h1>Connexion</h1>
  <?php if ($error){
    echo '<p class="alert alert-block alert-danger"> identifiants erronés </p>';
  }
  ?>

  <form class="" action="index.php?action=verifConnection" method="post">
    <div>
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" />
    </div>
    <div>
        <label for="password">Password</label><br />
        <input type="password" name="password" value="">
    </div>
    <div>
        <input type="submit" value="Connexion"/>
    </div>
  </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
