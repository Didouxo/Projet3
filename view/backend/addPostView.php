<?php $title = 'Mon blog'; ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div class="container">

<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>

<form action="<?= $form ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?= $titlePost ?>" />
    </div>
    <div>
        <label for="content">Billet</label><br />
        <textarea id="content" name="content"><?= $content ?></textarea>
    </div>
    <div>
      <label for="brouillon">Brouillon</label>
        <input type="checkbox" name="brouillon"/>
        <input type="submit" value="Publier"/>
    </div>
</form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>
