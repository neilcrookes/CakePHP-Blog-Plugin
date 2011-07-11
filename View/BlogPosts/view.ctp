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

      <?php echo $this->element('share'); ?>

      <?php if (strtolower($blogSettings['use_disqus']) == 'yes') : ?>

        <div id="disqus_thread"></div>
        <script type="text/javascript">
          /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
          var disqus_shortname = '<?php echo $blogSettings['disqus_shortname']; ?>'; // required: replace example with your forum shortname

          // The following are highly recommended additional parameters. Remove the slashes in front to use.
          var disqus_identifier = 'blog-post-<?php echo $blogPost['BlogPost']['id']; ?>';
          var disqus_url = '<?php echo $this->Blog->permalink($blogPost); ?>';

          <?php if (strtolower($blogSettings['disqus_developer']) == 'yes') : ?>
            var disqus_developer = 1;
          <?php endif; ?>

          /* * * DON'T EDIT BELOW THIS LINE * * */
          (function() {
              var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
              dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
              (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
          })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>

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
$this->set('metaDescription', $blogPost['BlogPost']['meta_description']);
$this->set('metaKeywords', $blogPost['BlogPost']['meta_keywords']);
$this->set('metaOgTitle', $blogPost['BlogPost']['title']);
$this->set('metaOgType', 'article');
$this->set('metaOgUrl', $this->Blog->permalink($blogPost));
//$this->set('metaOgImage');
$this->set('metaOgSiteName', $blogSettings['og:site_name']);
$this->set('metaFbAdmins', $blogSettings['fb_admins']);
