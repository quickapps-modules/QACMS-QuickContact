<div class="node node-full">
    <h2 class="node-title"><?php echo __d('quick_contact', 'Contact'); ?></h2>

    <?php $name = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.name') : ''; ?>
    <?php $email = QuickApps::is('user.logged') ? CakeSession::read('Auth.User.email') : ''; ?>
    <?php echo $this->Form->create('Contact'); ?>
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

    <p><?php echo $this->Form->end(__d('quick_contact', 'Send message')); ?></p>
</div>