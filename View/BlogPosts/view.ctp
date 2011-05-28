<div id="content">

  <aritcle>

    <header>
      <h2><?php echo $blogPost['BlogPost']['title']; ?></h2>
      <p class="published">
        Published on 
        <time pubdate datetime="<?php echo date('c', strtotime($blogPost['BlogPost']['created'])); ?>">
          <?php echo date('d M Y', strtotime($blogPost['BlogPost']['created'])); ?>
        </time>
      </p>
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

      <?php if ($blogSettings['show_categories_on_post_view'] && !empty($blogPost['BlogPostCategory'])) : ?>
        <nav id="categories">
          <p><?php echo __('Posted in '); ?></p>
          <?php echo $this->Blog->nav($blogPost['BlogPostCategory'], array('url' => array('action' => 'index'))); ?>
        </nav>
      <?php endif; ?>

      <?php if ($blogSettings['show_tags_on_post_view'] && !empty($blogPost['BlogPostTag'])) : ?>
        <nav id="tags">
          <p><?php echo __('Tagged with '); ?></p>
          <?php echo $this->Blog->nav($blogPost['BlogPostTag'], array('url' => array('action' => 'index'))); ?>
        </nav>
      <?php endif; ?>

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

