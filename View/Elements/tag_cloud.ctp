<?php
if (empty($tags)) {
  return;
}
?>
<section id="tag-cloud">
  <header>
    <h3><?php echo __('Tags'); ?></h3>
  </header>
  <nav>
    <?php echo $this->Blog->tagCloud($tags); ?>
  </nav>
</section>
