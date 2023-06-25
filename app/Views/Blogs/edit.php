<h2><?= esc($title) ?></h2>

<?php session()->setFlashdata('message', 'News item updated successfully.'); ?>
<?= validation_list_errors() ?>

<form action="/blogs/create" method="post">
   <?= csrf_field() ?>

   <label for="title">Title</label>
   <input type="input" name="title" value="<?= set_value('title') ?>">
   <br>

   <label for="body">Text</label>
   <textarea name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
   <br>

   <input type="submit" name="submit" value="Create news item">
</form>
