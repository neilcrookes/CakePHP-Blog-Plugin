<div class="blogPostTags index">
	<h2><?php echo __('Blog Post Tags');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('blog_post_count');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($blogPostTags as $blogPostTag):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo h($blogPostTag['BlogPostTag']['id']); ?>&nbsp;</td>
		<td><?php echo h($blogPostTag['BlogPostTag']['name']); ?>&nbsp;</td>
		<td><?php echo h($blogPostTag['BlogPostTag']['slug']); ?>&nbsp;</td>
		<td><?php echo h($blogPostTag['BlogPostTag']['blog_post_count']); ?>&nbsp;</td>
		<td><?php echo h($blogPostTag['BlogPostTag']['created']); ?>&nbsp;</td>
		<td><?php echo h($blogPostTag['BlogPostTag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $blogPostTag['BlogPostTag']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blogPostTag['BlogPostTag']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $blogPostTag['BlogPostTag']['id']), null, __('Are you sure you want to delete # %s?', $blogPostTag['BlogPostTag']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Blog Post Tag'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('controller' => 'blog_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>