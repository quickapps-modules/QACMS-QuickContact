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
<?php echo $this->Form->input('Contact.subject', array('label' => 'Subject *')); ?>

<?php echo $this->Form->label(__d('quick_contact', 'To')); ?>
<?php echo $this->Html->link($username, '/user/profile/' . $username); ?>

<?php echo $this->Form->input('Contact.message', array('type' => 'textarea', 'label' => __d('quick_contact', 'Message *'))); ?>
<?php echo $this->Form->input('Contact.copy', array('type' => 'checkbox', 'label' => __d('quick_contact', 'Send yourself a copy.'))); ?>

<p><?php echo $this->Form->submit(__d('quick_contact', 'Send message')); ?></p>

<?php echo $this->Form->end(); ?>