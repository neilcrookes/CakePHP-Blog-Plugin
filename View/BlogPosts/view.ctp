<div id="content">

  <article>

    <header class="clearfix">
      <h2><?php echo $blogPost['BlogPost']['title']; ?></h2>
      <time pubdate datetime="<?php echo date('c', strtotime($blogPost['BlogPost']['created'])); ?>">
        <?php echo date($blogSettings['published_format_on_post_view'], strtotime($blogPost['BlogPost']['created'])); ?>
      </time>
    </header>

    <?php if (strtolower($blogSettings['show_summary_on_post_view']) == 'yes') : ?>
      <p class="summary">
        <?php echo $blogPost['BlogPost']['summary']; ?>
      </p>
    <?php endif; ?>

    <div class="body">
      <?php echo $blogPost['BlogPost']['body']; ?>
    </div>

    <footer>

      <?php if (strtolower($blogSettings['show_categories_on_post_view']) == 'yes' && !empty($blogPost['BlogPostCategory'])) : ?>
        <nav id="categories">
          <p><?php echo __('Posted in '); ?></p>
          <?php echo $this->Blog->nav($blogPost['BlogPostCategory'], array('url' => array('action' => 'index'))); ?>
        </nav>
      <?php endif; ?>

      <?php if (strtolower($blogSettings['show_tags_on_post_view']) == 'yes' && !empty($blogPost['BlogPostTag'])) : ?>
        <nav id="tags">
          <p><?php echo __('Tagged with '); ?></p>
          <?php echo $this->Blog->nav($blogPost['BlogPostTag'], array('url' => array('action' => 'index'))); ?>
        </nav>
      <?php endif; ?>

      <ul class="share">
        <li><g:plusone size="medium"></g:plusone></li>
        <li><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a></li>
        <li><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&layout=button_count"
        scrolling="no" frameborder="0"
        style="border:none; width:90px; height:20px"></iframe></li>
      </ul>

    </footer>

  </article>

</div>

<div id="sidebar">

  <?php echo $this->element('rss'); ?>
  <?php echo $this->element('archives'); ?>
  <?php echo $this->element('categories'); ?>
  <?php echo $this->element('tag_cloud'); ?>

</div>

<?php
$this->set('title_for_layout', $blogPost['BlogPost']['meta_title']);
$this->set('metaDecsription', $blogPost['BlogPost']['meta_description']);
$this->set('metaKeywords', $blogPost['BlogPost']['meta_keywords']);
$this->set('metaOgTitle', $blogPost['BlogPost']['title']);
$this->set('metaOgType', 'article');
$this->set('metaOgUrl', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
//$this->set('metaOgImage');
$this->set('metaOgSiteName', $blogSettings['og:site_name']);
$this->set('metaFbAdmins', $blogSettings['fb_admins']);
