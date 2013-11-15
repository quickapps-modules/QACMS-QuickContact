<?php
	if (!isset($this->data['Contact']['name'])) {
		$name = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.name') : '';
	} else {
		$name = $this->data['Contact']['name'];
	}

	if (!isset($this->data['Contact']['email'])) {
		$email = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.email') : '';
	} else {
		$email = $this->data['Contact']['email'];
	}
?>
<?php echo $this->Form->create('Contact', array('url' => '/contact')); ?>
	<?php echo $this->Form->input('Contact.name', array('label' => __d('quick_contact', 'Your name *'), 'value' => $name)); ?>
	<?php echo $this->Form->input('Contact.email', array('label' => __d('quick_contact', 'Your email address *'), 'value' => $email)); ?>
	<?php echo $this->Form->input('Contact.subject', array('label' => __d('quick_contact', 'Subject *'))); ?>

	<?php if (!empty($categories)): ?>
		<?php if (count($categories) > 1): ?>
			<?php echo $this->Form->input('Contact.category', array('value' => $selected, 'type' => 'select', 'label' => __d('quick_contact', 'Category *'), 'options' => $categories)); ?>
		<?php else: ?>
			<?php $categories = array_keys($categories); ?>
			<?php echo $this->Form->hidden('Contact.category', array('value' => $categories[0])); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php echo $this->Form->input('Contact.message', array('type' => 'textarea', 'label' => __d('quick_contact', 'Message *'))); ?>
	<?php echo $this->Form->input('Contact.copy', array('type' => 'checkbox', 'label' => __d('quick_contact', 'Send yourself a copy.'))); ?>

	<?php if (QuickApps::is('QuickContact.termsOfUseEnabled')): ?>
		<fieldset class="terms-of-use">
			<legend><?php echo $this->Layout->hooktags(Configure::read('Modules.QuickContact.settings.terms_of_use_title')); ?></legend>
			<div class="terms-of-use-text"><?php echo $this->Layout->hooktags(Configure::read('Modules.QuickContact.settings.terms_of_use_text')); ?></div>
			<?php echo $this->Form->input('Contact.terms_of_use', array('type' => 'checkbox', 'value' => 1, 'label' => $this->Layout->hooktags(Configure::read('Modules.QuickContact.settings.terms_of_use_label')))); ?>
		</fieldset>
	<?php endif; ?>

	<?php if (QuickApps::is('QuickContact.captchaEnabled')): ?>
		<?php echo $this->element('QuickContact.captcha'); ?>
	<?php endif; ?>

	<p><?php echo $this->Form->submit(__d('quick_contact', 'Send message')); ?></p>
<?php echo $this->Form->end(); ?>
