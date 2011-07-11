<div id="content">

  <?php if ($this->Blog->filtered()) : ?>
    <p>Showing posts <?php echo $this->Blog->filterDescription(); ?>, <?php echo $this->Html->link(__('Show all', true), array('action' => 'index')); ?></p>
  <?php endif; ?>

  <?php if (!empty($blogPosts)) : ?>

    <?php foreach ($blogPosts as $blogPost) : ?>

      <article<?php if ($blogPost['BlogPost']['sticky']) {echo ' class="sticky"';} ?>>

        <header class="clearfix">
          <h2><?php echo $this->Html->link($blogPost['BlogPost']['title'], array('action' => 'view', 'slug' => $blogPost['BlogPost']['slug']), array('title' => $blogPost['BlogPost']['title'], 'rel' => 'bookmark')); ?></h2>
          <time pubdate datetime="<?php echo date('c', $createdTimestamp = strtotime($blogPost['BlogPost']['created'])); ?>">
              <?php echo date($blogSettings['published_format_on_post_index'], $createdTimestamp); ?>
          </time>
          <?php if (strtolower($blogSettings['use_disqus']) == 'yes') : ?>
            <?php echo $this->Html->link(__('View comments'), $this->Blog->permalink($blogPost) . '#disqus_thread', array('data-disqus-identifier' => 'blog-post-' . $blogPost['BlogPost']['id'])); ?>
          <?php endif; ?>
          
        </header>

        <?php if (strtolower($blogSettings['use_summary_or_body_on_post_index']) == 'summary') : ?>
          <p class="summary"><?php echo $blogPost['BlogPost']['summary']; ?></p>
        <?php else : ?>
          <div class="post">
            <?php echo $blogPost['BlogPost']['body']; ?>
          </div>
        <?php endif; ?>

      </article>

    <?php endforeach; ?>

    <?php
    $paging = $this->Paginator->params();
    if ($paging['pageCount'] > 1) :
      ?>
      <nav id="paging">
        <?php
        $this->Paginator->options(array('url' => $this->Blog->getPaginatorOptions()));
        echo $this->Paginator->prev('« Newer posts', null, null, array('class' => 'disabled'));
        echo $this->Paginator->next('Older posts »', null, null, array('class' => 'disabled'));
        ?>
      </nav>
    <?php endif; ?>

  <?php else : ?>

    <p><?php echo __('Sorry, there are no blog posts.'); ?></p>

  <?php endif; ?>

</div>

<div id="sidebar">

  <?php echo $this->element('rss'); ?>
  <?php echo $this->element('archives'); ?>
  <?php echo $this->element('categories'); ?>
  <?php echo $this->element('tag_cloud'); ?>

</div>

<?php if (strtolower($blogSettings['use_disqus']) == 'yes') : ?>

  <script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = '<?php echo $blogSettings['disqus_shortname']; ?>'; // required: replace example with your forum shortname

    <?php if (strtolower($blogSettings['disqus_developer']) == 'yes') : ?>
      var disqus_developer = 1;
    <?php endif; ?>

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
        var s = document.createElement('script'); s.async = true;
        s.type = 'text/javascript';
        s.src = 'http://' + disqus_shortname + '.disqus.com/count.js';
        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());
  </script>

<?php endif; ?>

<?php

// Set the meta title, description and keywords according to the default
// settings or the filtered category or tag.

switch ($this->Blog->filtered()) {
  case 'category':
    $this->set('title_for_layout', $category['BlogPostCategory']['meta_title']);
    $this->set('metaDescription', $category['BlogPostCategory']['meta_description']);
    $this->set('metaKeywords', $category['BlogPostCategory']['meta_keywords']);
    break;
  case 'tag':
    $this->set('title_for_layout', $tag['BlogPostTag']['meta_title']);
    $this->set('metaDescription', $tag['BlogPostTag']['meta_description']);
    $this->set('metaKeywords', $tag['BlogPostTag']['meta_keywords']);
    break;
  default:
    $this->set('title_for_layout', $blogSettings['meta_title']);
    $this->set('metaDescription', $blogSettings['meta_description']);
    $this->set('metaKeywords', $blogSettings['meta_keywords']);
    break;
}
