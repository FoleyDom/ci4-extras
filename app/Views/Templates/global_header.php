<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="<?=base_url('./css/output.css')?>">
   <title><?=esc($tab_title)?></title>
</head>
<header class="text-gray-400 bg-gray-900 body-font">
   <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
      <nav class="flex lg:w-2/5 flex-wrap items-center text-base md:ml-auto">
         <?php if (auth()->loggedIn()): ?>
         <a href="/blogs/" class="mr-5 hover:text-white">Blogs</a>
         <?php else: ?>
         <a href="/" class="mr-5 hover:text-white">Home</a>
         <a href="/blogs/" class="mr-5 hover:text-white">Blog</a>
         <?php endif; ?>
         <a class="mr-5 hover:text-white">Third Link</a>
         <a class="hover:text-white">Fourth Link</a>
      </nav>
      <a href="/" class="flex order-first lg:order-none lg:w-1/5 title-font font-medium items-center text-white lg:items-center lg:justify-center mb-4 md:mb-0">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-yellow-500 rounded-full" viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
         </svg>
         <span class="ml-3 text-xl xl:block lg:hidden">Blog-Space</span>
      </a>
      <?php if (auth()->loggedIn()): ?>
         <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            <a href="/logout/">
               <button class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0 mr-2">Logout
               </button>
            </a>
         </div>
      <?php else: ?>
         <div class="lg:w-2/5 inline-flex lg:justify-end ml-5 lg:ml-0">
            <a href="/login/">
               <button class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0 mr-2">Login
               </button>
            </a>
            <a href="/register/">
               <button class="inline-flex items-center bg-gray-800 border-0 py-1 px-3 focus:outline-none hover:bg-gray-700 rounded text-base mt-4 md:mt-0">Sign Up
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                     <path d="M5 12h14M12 5l7 7-7 7"></path>
                  </svg>
               </button>
            </a>
         </div>
      <?php endif;?>
</header>

<body>