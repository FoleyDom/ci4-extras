<h2><?= esc($title) ?></h2>
<p><a href="/news/create/">Create a new post</a></p>
<?php if(!empty($news) && is_array($news)): ?>
   <?php foreach($news as $news_item): ?>
      <h3><?= esc($news_item['title']) ?></h3>
      <div class="main">
         <?= esc($news_item['body']) ?>
      </div>
      <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></p>
   <?php endforeach; ?>
<?php else: ?>
   <h3>No News</h3>
   <p>Unable to find any news for you.</p>
<?php endif ?>