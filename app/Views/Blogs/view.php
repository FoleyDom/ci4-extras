<section class="text-gray-400 bg-gray-900 body-font">
   <div class="container mx-auto flex px-5 py-24 items-center justify-center flex-col">
      <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
      <div class="text-center lg:w-2/3 w-full">
         <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-white"><?= esc($news['title']) ?></h1>
         <p class="leading-relaxed mb-8"><?= esc($news['body']) ?></p>
         <div class="flex justify-center">
            <?php if (auth()->loggedIn()) : ?>
               <a href="/blogs/edit/<?= esc($news['slug'], 'url') ?>"><button class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg m-2">Edit</button></a>
               <a href="/blogs/delete/<?= esc($news['slug'], 'url') ?>"><button class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg m-2">Delete</button></a>
               <a href="/"><button class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg">Go Back</button></a>
            <?php else : ?>
               <a href="/blogs/"><button class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg">Go Back</button></a>
            <?php endif; ?>
         </div>
      </div>
   </div>
</section>