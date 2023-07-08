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
   <!-- Calendar Links
   <link rel="dns-prefetch" href="//unpkg.com" />
   <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
   <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
   <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script> -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />

   <!--  -->
   <!-- Page Tittle -->
   <title><?= esc($tab_title) ?></title>
</head>

<?php echo view('front/Components/nav_bar.php') ?>

<body>