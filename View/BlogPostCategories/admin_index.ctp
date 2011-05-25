<div class="blogPostCategories index">
	<h2><?php echo __('Blog Post Categories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('parent_id');?></th>
			<th><?php echo $this->Paginator->sort('lft');?></th>
			<th><?php echo $this->Paginator->sort('rght');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('blog_post_count');?></th>
			<th><?php echo $this->Paginator->sort('under_blog_post_count');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($blogPostCategories as $blogPostCategory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['lft']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['rght']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['slug']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['blog_post_count']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['under_blog_post_count']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['created']); ?>&nbsp;</td>
		<td><?php echo h($blogPostCategory['BlogPostCategory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $blogPostCategory['BlogPostCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blogPostCategory['BlogPostCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blogPostCategory['BlogPostCategory']['id']), null, __('Are you sure you want to delete # %s?', $blogPostCategory['BlogPostCategory']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%')
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous'), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next') . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Blog Post Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('controller' => 'blog_post_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('controller' => 'blog_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
