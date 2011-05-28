<?php 
if (empty($categories)) {
  return;
}
?>
<section id="categories">
  <header>
    <h3><?php echo __('Categories'); ?></h3>
  </header>
  <nav>
    <?php echo $this->Blog->nav($categories); ?>
  </nav>
</section>
