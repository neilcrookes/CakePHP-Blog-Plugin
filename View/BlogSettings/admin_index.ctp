<div class="blogSettings index">
	<h2><?php echo __('Blog Settings');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('setting_text');?></th>
			<th><?php echo $this->Paginator->sort('value');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($blogSettings as $blogSetting):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo h($blogSetting['BlogSetting']['id']); ?>&nbsp;</td>
		<td><?php echo h($this->Text->truncate($blogSetting['BlogSetting']['setting_text'], 100)); ?>&nbsp;</td>
		<td><?php echo h($this->Text->truncate($blogSetting['BlogSetting']['value'], 100)); ?>&nbsp;</td>
		<td><?php echo $this->Time->nice($blogSetting['BlogSetting']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $blogSetting['BlogSetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $blogSetting['BlogSetting']['id'])); ?>
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
	</ul>
</div>
