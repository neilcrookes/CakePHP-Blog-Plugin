<section id="rss">
  <header>
    <h3>Subscribe</h3>
  </header>
  <nav>
    <ul>
      <li><?php echo $this->Blog->rss(__('RSS for all posts', true)); ?></li>
      <?php
      $filteredBy = $this->Blog->filtered();
      if ($filteredBy && in_array($filteredBy, array('category', 'tag'))) {
        echo '<li>' . $this->Blog->rssFiltered($filteredBy, __('RSS for posts ' . $this->Blog->filterDescription(), true)) . '</li>';
      }
      ?>
    </ul>
  </nav>
  <?php echo $this->Blog->rssLinkTag(); ?>
</section>
