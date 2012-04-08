<div class="node node-full">
    <h2 class="node-title"><?php echo __d('quick_contact', 'Contact'); ?></h2>

    <?php $name = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.name') : ''; ?>
    <?php $email = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.email') : ''; ?>
    <?php echo $this->Form->create('Contact'); ?>
    <?php echo $this->Form->input('Contact.name', array('label' => __d('quick_contact', 'Your name *'), 'value' => $name)); ?>
    <?php echo $this->Form->input('Contact.email', array('label' => __d('quick_contact', 'Your email address *'), 'value' => $email)); ?>
    <?php echo $this->Form->input('Contact.subject', array('label' => 'Subject *')); ?>

    <?php echo $this->Form->label(__d('quick_contact', 'To')); ?>
    <?php echo $this->Html->link($username, '/user/profile/' . $username); ?>

    <?php echo $this->Form->input('Contact.message', array('type' => 'textarea', 'label' => __d('quick_contact', 'Message *'))); ?>
    <?php echo $this->Form->input('Contact.copy', array('type' => 'checkbox', 'label' => __d('quick_contact', 'Send yourself a copy.'))); ?>

    <p><?php echo $this->Form->end('Send message'); ?></p>
</div>