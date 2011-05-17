<div class="blogPostCategories form">
<?php echo $this->Form->create('BlogPostCategory');?>
	<fieldset>
		<legend><?php __('Edit Blog Post Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('parent_id', array('empty' => true));
		echo $this->Form->input('name');
		echo $this->Form->input('slug');
                echo $this->Form->input('meta_title');
                echo $this->Form->input('meta_description');
                echo $this->Form->input('meta_keywords');
                echo $this->Form->input('rss_channel_title');
                echo $this->Form->input('rss_channel_description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BlogPostCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BlogPostCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('controller' => 'blog_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
