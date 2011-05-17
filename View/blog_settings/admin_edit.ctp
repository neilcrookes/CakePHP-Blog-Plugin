<div class="blogSettings form">
<?php echo $this->Form->create('BlogSetting');?>
	<fieldset>
		<legend><?php __('Admin Edit Blog Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		$options = array(
			'type' => 'textarea',
			'label' => $blogSetting['BlogSetting']['setting_text'],
		);
		if (!empty($blogSetting['BlogSetting']['tip'])) {
			$options['after'] = '<p class="tip">'.$blogSetting['BlogSetting']['tip'].'</p>';
		}
		echo $this->Form->input('value', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Blog Settings'), array('action' => 'index'));?></li>
	</ul>
</div>
