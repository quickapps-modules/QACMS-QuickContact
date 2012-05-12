<?php echo $this->Form->create('ContactCategory'); ?>
	<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', __d('quick_contact', 'Add new category'))); ?>
		<?php echo $this->Form->input('ContactCategory.name', array('label' => __d('quick_contact', 'Category name *'))); ?>
		<em><?php echo __d('quick_contact', __d('quick_contact', "Example: 'website feedback' or 'product information'.")); ?></em>

		<?php echo $this->Form->input('ContactCategory.recipients', array('label' => 'Recipients *')); ?>
		<em><?php echo __d('quick_contact', __d('quick_contact', "Example: 'webmaster@example.com' or 'sales@example.com,support@example.com' . To specify multiple recipients, separate each e-mail address with a comma.")); ?></em>

		<?php echo $this->Form->input('ContactCategory.reply', array('label' => 'Auto-reply')); ?>
		<em><?php echo __d('quick_contact', __d('quick_contact', "Optional auto-reply. Leave empty if you do not want to send the user an auto-reply message.")); ?></em>

		<?php echo $this->Form->input('ContactCategory.selected', array('label' => 'Selected', 'type' => 'checkbox')); ?>
		<em><?php echo __d('quick_contact', __d('quick_contact', "Check this if you would like this category to be selected by default.")); ?></em>
	<?php echo $this->Html->useTag('fieldsetend'); ?>

	<?php echo $this->Form->submit(__d('quick_contact', 'Save')); ?>
<?php echo $this->Form->end(); ?>