<?php
/**
 * Routes file for CakePHP Blog Plugin
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 */

Router::parseExtensions('rss');

Router::connect(
  '/blog/:year/:month/*',
  array(
    'plugin' => 'blog',
    'controller' => 'blog_posts',
    'action' => 'index'
  ),
  array(
    'pass' => array('year', 'month'),
    'year' => '2[0-9]{3}',
    'month' => '0[1-9]|1[012]',
  )
);

Router::connect(
  '/blog/category/:category/*',
  array(
    'plugin' => 'blog',
    'controller' => 'blog_posts',
    'action' => 'index'
  ),
  array(
    'pass' => array('category'),
    'category' => '[a-zA-Z0-9\-\_]+',
  )
);

Router::connect(
  '/blog/tag/:tag/*',
  array(
    'plugin' => 'blog',
    'controller' => 'blog_posts',
    'action' => 'index'
  ),
  array(
    'pass' => array('tag'),
    'category' => '[a-zA-Z0-9\-\_]+',
  )
);

Router::connect(
  '/blog/:slug',
  array(
    'plugin' => 'blog',
    'controller' => 'blog_posts',
    'action' => 'view'
  ),
  array(
    'slug' => '[a-zA-Z0-9\-\_]+',
  )
);

Router::connect('/blog/*', array(
  'plugin' => 'blog',
  'controller' => 'blog_posts',
  'action' => 'index',
));
