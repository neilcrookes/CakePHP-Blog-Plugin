<div class="blogPosts view">
<h2><?php  echo __('Blog Post');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['id']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['title']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['slug']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Summary'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['summary']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Sticky'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['sticky']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('In Rss'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['in_rss']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Meta Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['meta_title']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Meta Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['meta_description']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Meta Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['meta_keywords']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPost['BlogPost']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Blog Post'), array('action' => 'edit', $blogPost['BlogPost']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Blog Post'), array('action' => 'delete', $blogPost['BlogPost']['id']), null, __('Are you sure you want to delete # %s?', $blogPost['BlogPost']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('controller' => 'blog_post_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Tags'), array('controller' => 'blog_post_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Tag'), array('controller' => 'blog_post_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Post Categories');?></h3>
	<?php if (!empty($blogPost['BlogPostCategory'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Blog Post Count'); ?></th>
		<th><?php echo __('Under Blog Post Count'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blogPost['BlogPostCategory'] as $blogPostCategory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $blogPostCategory['id'];?></td>
			<td><?php echo $blogPostCategory['parent_id'];?></td>
			<td><?php echo $blogPostCategory['lft'];?></td>
			<td><?php echo $blogPostCategory['rght'];?></td>
			<td><?php echo $blogPostCategory['name'];?></td>
			<td><?php echo $blogPostCategory['slug'];?></td>
			<td><?php echo $blogPostCategory['blog_post_count'];?></td>
			<td><?php echo $blogPostCategory['under_blog_post_count'];?></td>
			<td><?php echo $blogPostCategory['created'];?></td>
			<td><?php echo $blogPostCategory['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blog_post_categories', 'action' => 'view', $blogPostCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blog_post_categories', 'action' => 'edit', $blogPostCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blog_post_categories', 'action' => 'delete', $blogPostCategory['id']), null, __('Are you sure you want to delete # %s?', $blogPostCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Post Tags');?></h3>
	<?php if (!empty($blogPost['BlogPostTag'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Slug'); ?></th>
		<th><?php echo __('Blog Post Count'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($blogPost['BlogPostTag'] as $blogPostTag):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $blogPostTag['id'];?></td>
			<td><?php echo $blogPostTag['name'];?></td>
			<td><?php echo $blogPostTag['slug'];?></td>
			<td><?php echo $blogPostTag['blog_post_count'];?></td>
			<td><?php echo $blogPostTag['created'];?></td>
			<td><?php echo $blogPostTag['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blog_post_tags', 'action' => 'view', $blogPostTag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blog_post_tags', 'action' => 'edit', $blogPostTag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blog_post_tags', 'action' => 'delete', $blogPostTag['id']), null, __('Are you sure you want to delete # %s?', $blogPostTag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Blog Post Tag'), array('controller' => 'blog_post_tags', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
