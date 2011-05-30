<?php

$this->set('channel', array(
  'title' => $this->Blog->rssChannelTitle(),
  'link' => $this->Blog->rssChannelLink(),
  'description' => $this->Blog->rssChannelDescription(),
));

App::uses('Sanitize', 'Utility');

foreach ($blogPosts as $blogPost) {

  echo $this->Rss->item(array(), array(
    'title' => $blogPost['BlogPost']['title'],
    'link' => array(
      'plugin' => 'blog',
      'controller' => 'blog_posts',
      'action' => 'view',
      'slug' => $blogPost['BlogPost']['slug']
    ),
    'description' => Sanitize::stripScripts($blogPost['BlogPost']['summary']),
    'pubDate' => strtotime($blogPost['BlogPost']['created'])
  ));

}
