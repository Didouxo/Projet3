<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Connection</h1>
<?php if ($error){
  echo '<p> identifiants erronés </p>';
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
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>