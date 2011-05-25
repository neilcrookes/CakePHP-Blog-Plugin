<div class="blogPosts form">
<?php echo $this->Form->create('BlogPost');?>
	<fieldset>
		<legend><?php __('Add Blog Post'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('slug');
		echo $this->Form->input('summary');
		echo $this->Form->input('body');
		echo $this->Form->input('published');
		echo $this->Form->input('sticky');
		echo $this->Form->input('in_rss', array('default' => 1));
		echo $this->Form->input('meta_title');
		echo $this->Form->input('meta_description');
		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('BlogPostCategory');
		echo $this->Form->input('BlogPostTag');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Blog Posts'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('controller' => 'blog_post_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Tags'), array('controller' => 'blog_post_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Tag'), array('controller' => 'blog_post_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
