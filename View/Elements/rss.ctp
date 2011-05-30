<section id="rss">
  <header>
    <h3>Subscribe</h3>
  </header>
  <nav>
    <ul>
      <li>
        <link rel="alternate" type="application/rss+xml" href="<?php echo $this->Blog->rssUrl(); ?>" title="<?php echo $blogSettings['rss_channel_title']; ?>">
        <?php echo $this->Blog->rss(__('RSS for all posts', true)); ?>
      </li>
      <?php
      $filteredBy = $this->Blog->filtered();
      if ($filteredBy && in_array($filteredBy, array('category', 'tag'))) {
        echo '<link rel="alternate" type="application/rss+xml" href="' . $this->Blog->rssUrl(array($filteredBy)) . '" title="' . $blogSettings['rss_channel_title'] . '">';
        echo '<li>' . $this->Blog->rssFiltered($filteredBy, __('RSS for posts ' . $this->Blog->filterDescription(), true)) . '</li>';
      }
      ?>
    </ul>
  </nav>
</section>
