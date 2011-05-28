<?php
if (empty($archives)) {
  return;
}
?>
<section id="archives">
  <header>
    <h3><?php echo __('Archives'); ?></h3>
  </header>
  <nav>
    <?php echo $this->Blog->nav($archives); ?>
  </nav>
</section>
