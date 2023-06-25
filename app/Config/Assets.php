<?php
namespace Config;
use CodeIgniter\Config\BaseConfig;

class Assets extends BaseConfig
{
   public $assets = [
      'js' => [
         '0' => [
            'path' => 'js/jquery/jquery.min.js',
            'content_type' => 'text/javascript',
            'version' => '3.2.1',
            'dependencies' => [],
            'exclude' => [],
            'combine' => false,
            'minify' => false,
            'attributes' => [],
         ],
         '1' => [  
            'path' => 'js/bootstrap/bootstrap.bundle.min.js',
            'content_type' => 'text/javascript',
            'version' => '5.1.3',
            'dependencies' => [],
            'exclude' => [],
            'combine' => false,
            'minify' => false,
            'attributes' => [],
         ]
      ],
      'css' => [
         '0' => [
            'path' => 'css/bootstrap/bootstrap.min.css',
            'content_type' => 'text/css',
            'version' => '5.1.3',
            'dependencies' => [],
            'exclude' => [],
            'combine' => false,
            'minify' => false,
            'attributes' => [],
         ],
         '1' => [
            'path' => 'css/fontawesome/fontawesome.css',
            'content_type' => 'text/css',
            'version' => '4.7.0',
            'dependencies' => [],
            'exclude' => [],
            'combine' => false,
            'minify' => true,
            'attributes' => [],
         ]
      ]
   ];
}
//    // fs_directory = string
//    // The filesystem directory of the assets
//    $config['fs_directory']    =  'public/';

//    // base_path = string
//    // The absolute filesystem path of the assets
//    $config['base_path']       = APPPATH . $config['fs_directory'];

//    // sites = array
//    // The sections of the application supported. Matches top directories in fs_directory
//    $config['sites']           = array('front_resources','admin_resources');

//    // types = array
//    // The supported file types and related settings
//    $config['types']           = array(

//       'js'   => array('directory' => 'js',    'content_type' => 'text/javascript', 'combine' => TRUE,   'evaluate' => TRUE,  'minify' => FALSE ),
//       'css'  => array('directory' => 'css',   'content_type' => 'text/css', 'combine' => TRUE,   'evaluate' => TRUE , 'minify' => FALSE),
//       'ttf'  => array('directory' => 'fonts', 'content_type' => 'application/x-font-ttf',    'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  ),
//       'map'  => array('directory' => 'css',   'content_type' => 'application/octet-stream',  'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  ),
//       'svg'  => array('directory' => 'fonts', 'content_type' => 'application/octet-stream',  'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  ),
//       'eot'  => array('directory' => 'fonts', 'content_type' => 'application/octet-stream',  'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  ),
//       'woff' => array('directory' => 'fonts', 'content_type' => 'application/x-font-woff',  'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  ),
//       'woff2' => array('directory' => 'fonts', 'content_type' => 'application/x-font-woff2',  'combine' => FALSE,  'evaluate' => FALSE, 'minify' => FALSE  )

//       );

//    // minify - boolean
//    // Turn minification on / off globally. Overrides individual setting
//    $config['minify']          = FALSE;

//    // cache_time = integer
//    // Number of minutes to cache assets, 0 for off
//    $config['cache_time']      = 1440;
// }
?>