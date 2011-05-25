<div class="blogPostCategories view">
<h2><?php  echo __('Blog Post Category');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Parent Blog Post Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($blogPostCategory['ParentBlogPostCategory']['name'], array('controller' => 'blog_post_categories', 'action' => 'view', $blogPostCategory['ParentBlogPostCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Slug'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['slug']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Blog Post Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['blog_post_count']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Under Blog Post Count'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['under_blog_post_count']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo h($blogPostCategory['BlogPostCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Blog Post Category'), array('action' => 'edit', $blogPostCategory['BlogPostCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Blog Post Category'), array('action' => 'delete', $blogPostCategory['BlogPostCategory']['id']), null, __('Are you sure you want to delete # %s?', $blogPostCategory['BlogPostCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Post Categories'), array('controller' => 'blog_post_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Blog Posts'), array('controller' => 'blog_posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Blog Post'), array('controller' => 'blog_posts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Post Categories');?></h3>
	<?php if (!empty($blogPostCategory['ChildBlogPostCategory'])):?>
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
		foreach ($blogPostCategory['ChildBlogPostCategory'] as $childBlogPostCategory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $childBlogPostCategory['id'];?></td>
			<td><?php echo $childBlogPostCategory['parent_id'];?></td>
			<td><?php echo $childBlogPostCategory['lft'];?></td>
			<td><?php echo $childBlogPostCategory['rght'];?></td>
			<td><?php echo $childBlogPostCategory['name'];?></td>
			<td><?php echo $childBlogPostCategory['slug'];?></td>
			<td><?php echo $childBlogPostCategory['blog_post_count'];?></td>
			<td><?php echo $childBlogPostCategory['under_blog_post_count'];?></td>
			<td><?php echo $childBlogPostCategory['created'];?></td>
			<td><?php echo $childBlogPostCategory['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'blog_post_categories', 'action' => 'view', $childBlogPostCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'blog_post_categories', 'action' => 'edit', $childBlogPostCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'blog_post_categories', 'action' => 'delete', $childBlogPostCategory['id']), null, __('Are you sure you want to delete # %s?', $childBlogPostCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Blog Post Category'), array('controller' => 'blog_post_categories', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Blog Posts');?></h3>
	<?php if (!empty($blogPostCategory['BlogPost'])):?>
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
		foreach ($blogPostCategory['BlogPost'] as $blogPost):
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
