<h2><?= esc($title) ?></h2>
<p><a class="rounded-lg bg-gray-100 px-5 py-2 text-sm font-medium text-gray-500" href="/news/create/">Create a new post</a></p>
<?php

 if(!empty($news) && is_array($news)): ?>
   <?php foreach($news as $news_item): ?>
      <h3><?= esc($news_item['title']) ?></h3>
      <div class="main">
         <?= esc($news_item['body']) ?>
      </div>
      <button class="rounded-lg bg-gray-100 px-5 py-2 text-sm font-medium text-gray-500"><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></button>
      <?php if (auth()->loggedIn()): ?>
         <a class="rounded-lg bg-gray-100 px-5 py-2 text-sm font-medium text-gray-500" href="/news/edit/<?= esc($news_item['slug'], 'url') ?>">Edit</a>
         <a class="rounded-lg bg-gray-100 px-5 py-2 text-sm font-medium text-gray-500" href="/news/delete/<?= esc($news_item['slug'], 'url') ?>">Delete</a> 
      <?php endif; ?>
   <?php endforeach; ?>
<?php else: ?>
   <h3>No News</h3>
   <p>Unable to find any news for you.</p>
<?php endif ?>