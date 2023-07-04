<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php if (isset($styles)) :
      foreach ($styles as $style) :
         echo $style;
      endforeach;
   else : ?>
      <link rel="stylesheet" href="<?= base_url('./css/output.css') ?>">
   <?php
   endif;
   ?>
   <!-- JQuery CDN -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
   <!-- Page Tittle -->
   <title><?= esc($tab_title) ?></title>
</head>

<?php echo view('front/Components/nav_bar.php') ?>

<body>