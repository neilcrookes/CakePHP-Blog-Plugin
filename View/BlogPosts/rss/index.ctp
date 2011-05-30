<?php

$rssChannelLink = array(
  'plugin' => 'blog',
  'controller' => 'blog_posts',
  'action' => 'index',
);

switch ($this->Blog->filtered()) {
  case 'category':
    $rssChannelTitle = $category['BlogPostCategory']['rss_channel_title'];
    $rssChannelDescription = $category['BlogPostCategory']['rss_channel_description'];
    $rssChannelLink['category'] = $this->params['category'];
    break;
  case 'tag':
    $rssChannelTitle = $tag['BlogPostTag']['rss_channel_title'];
    $rssChannelDescription = $tag['BlogPostTag']['rss_channel_description'];
    $rssChannelLink['tag'] = $this->params['tag'];
    break;
  default:
    $rssChannelTitle = $blogSettings['rss_channel_title'];
    $rssChannelDescription = $blogSettings['rss_channel_description'];
    break;
}

$this->set('channel', array(
  'title' => $rssChannelTitle,
  'link' => $rssChannelLink,
  'description' => $rssChannelDescription,
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
