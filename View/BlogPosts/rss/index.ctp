<?php

$this->set('channel', array(
  'title' => $this->Blog->rssChannelTitle(),
  'link' => $this->Blog->rssChannelLink(),
  'description' => $this->Blog->rssChannelDescription(),
));

App::uses('Sanitize', 'Utility');

foreach ($blogPosts as $blogPost) {

  if (strtolower($blogSettings['use_summary_or_body_in_rss_feed']) == 'body') {
    $description = $blogPost['BlogPost']['body'];
  } else {
    $description = $blogPost['BlogPost']['summary'];
  }

  echo $this->Rss->item(array(), array(
    'title' => $blogPost['BlogPost']['title'],
    'link' => array(
      'plugin' => 'blog',
      'controller' => 'blog_posts',
      'action' => 'view',
      'slug' => $blogPost['BlogPost']['slug']
    ),
    'description' => Sanitize::stripScripts($description),
    'pubDate' => strtotime($blogPost['BlogPost']['created'])
  ));

}
