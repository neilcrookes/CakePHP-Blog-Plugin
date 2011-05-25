<div class="blogPostTags view">
<h2><?php  echo __('Blog Post Tag');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['id']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['name']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['slug']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Blog Post Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['blog_post_count']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostTag['BlogPostTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Blog Post Tag'), array('action' => 'edit', $blogPostTag['BlogPostTag']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Blog Post Tag'), array('action' => 'delete', $blogPostTag['BlogPostTag']['id']), null, __('Are you sure you want to delete # %s?', $blogPostTag['BlogPostTag']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Tags'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Tag'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('controller' => 'blog_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Posts');?></h3>
	<?php if (!empty($blogPostTag['BlogPost'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Summary'); ?></th>
		<th><?php echo __('Sticky'); ?></th>
		<th><?php echo __('In Rss'); ?></th>
		<th><?php echo __('Meta Title'); ?></th>
		<th><?php echo __('Meta Description'); ?></th>
		<th><?php echo __('Meta Keywords'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blogPostTag['BlogPost'] as $blogPost):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $blogPost['id'];?></td>
			<td><?php echo $blogPost['title'];?></td>
			<td><?php echo $blogPost['slug'];?></td>
			<td><?php echo $blogPost['summary'];?></td>
			<td><?php echo $blogPost['sticky'];?></td>
			<td><?php echo $blogPost['in_rss'];?></td>
			<td><?php echo $blogPost['meta_title'];?></td>
			<td><?php echo $blogPost['meta_description'];?></td>
			<td><?php echo $blogPost['meta_keywords'];?></td>
			<td><?php echo $blogPost['created'];?></td>
			<td><?php echo $blogPost['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blog_posts', 'action' => 'view', $blogPost['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blog_posts', 'action' => 'edit', $blogPost['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blog_posts', 'action' => 'delete', $blogPost['id']), null, __('Are you sure you want to delete # %s?', $blogPost['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
