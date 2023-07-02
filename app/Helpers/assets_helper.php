<?php

if (!function_exists('add_assets')) {
   /**
    * Add an asset to the list of assets to be loaded
    * returns a string with the path to the asset compriosed of input parameters $group/$type/$file
    *
    * @param string OR array $file The file name to be included. Can also include a path if subfolder is deeper than $group/$type.
    * @param string $type The type of asset 'css' or 'js'
    * @param string $group The group that this asset belongs to 'global', 'front' or 'admin'
    * @param boolean $minify If true, minify the asset before adding it
    * @return void
    *
    * TODO: Add support for minifying CSS and JS
    * TODO: Add support for loading assets from a CDN
    * TODO: Add support for checking if an asset has already been added
    * TODO: Add support for checking if an asset is where its supposed to be
    */

   function add_assets($file, $type = 'js', $group = 'global', $minify = false)
   {
      $asset_array = array();

      if ($type == 'css') {
         $content_type = 'text/css';
      } elseif ($type == 'js') {
         $content_type = 'text/javascript';
      }

      if ($group === 'admin') {
         if (is_array($file)) {
            foreach ($file as $f) {
               $file_path = 'admin_resources/' . $type . '/' . $f;
               $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
            }
         } else {
            $file_path = 'admin_resources/' . $type . '/' . $file;
            $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
         }
      } elseif ($group === 'front') {
         if (is_array($file)) {
            foreach ($file as $f) {
               $file_path = 'front_resources/' . $type . '/' . $f;
               $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
            }
         } else {
            $file_path = 'front_resources/' . $type . '/' . $file;
            $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
         }
      } elseif ($group === 'global') {
         if (is_array($file)) {
            foreach ($file as $f) {
               $file_path = $type . '/' . $f;
               $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
            }
         } else {
            $file_path = $type . '/' . $file;
            $asset_array[$type][] = array('path' => $file_path, 'content_type' => $content_type, 'minify' => $minify);
         }
      }
      return $asset_array;
   }
}

if (!function_exists('get_assets')) {
   /**
    * 
    * @param array Array of asset information to be transformed into a string
    *
    * @return array Array of strings with the full tag for each asset
    */
   function get_assets_output($assets_array)
   {
      $global_assets = config('Assets');
      $output = array();

      foreach ($assets_array as $type => $assets) {
         // merge and format all our css from gloabal assets config and input array
         if (isset($assets['css'])) {
            $merged_css = array_merge($global_assets->assets['css'], $assets['css']);
            foreach ($merged_css as $asset) {
               $output['css'][] = '<link rel="stylesheet" type="' . $asset['content_type'] . '" href="/' . $asset['path'] . '" />';
            }
         }
         // merge and format all our js from gloabal assets config and input array
         if (isset($assets['js'])) {
            $merged_js = $assets['js'];
            foreach ($merged_js as $asset) {
               $output['js'][] = '<script type="' . $asset['content_type'] . '" src="/' . $asset['path'] . '"></script>';
            }
         }
      }
      return $output;
   }
}
