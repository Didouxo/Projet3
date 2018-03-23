<?php $title = 'Mon blog'; ?>

<?php $connection = '' ?>

<?php ob_start(); ?>

<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div class="container">

<p><a href="<?= $backUrl ?>">Retour à la liste des billets</a></p>

<form action="index.php?action=addPost" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="content">Billet</label><br />
        <textarea id="content" name="content"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
