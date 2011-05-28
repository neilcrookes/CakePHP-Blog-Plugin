<section id="rss">
  <?php echo $this->Blog->rss(); ?>
  <?php
  $filteredBy = $this->Blog->filtered();
  if ($filteredBy && in_array($filteredBy, array('category', 'tag'))) {
    echo $this->Blog->rssFiltered($filteredBy, __('RSS for posts ' . $this->Blog->filterDescription(), true));
  }
  ?>
</section>
