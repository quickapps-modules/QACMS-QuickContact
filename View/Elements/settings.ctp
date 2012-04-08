<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'E-mail transport')); ?>
    <?php
        $value = !isset($this->data['Module']['settings']['transport']) ? 'php' : $this->data['Module']['settings']['transport'];

        echo $this->Form->input('Module.settings.transport',
            array(
                'type' => 'radio',
                'value' => $value,
                'options' => array(
                    'php' => 'PHP mail() function',
                    'smtp' => 'SMTP'
                ),
                'separator' => '<br />',
                'class' => 'transport-type',
                'onclick' => "if ($('.transport-type:checked').val() == 'smtp') { $('#smtp-settings').show(); } else { $('#smtp-settings').hide(); }"
            )
        );
    ?>

    <div id="smtp-settings" style="<?php echo $this->data['Module']['settings']['transport'] != 'smtp' ? 'display:none;' : ''; ?>">
        <?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'SMTP settings')); ?>
            <?php echo $this->Form->input('Module.settings.smtp_host', array('label' => 'SMTP host')); ?>
            <?php echo $this->Form->input('Module.settings.smtp_port', array('label' => 'SMTP port')); ?>
            <?php echo $this->Form->input('Module.settings.smtp_username', array('label' => 'SMTP user name')); ?>
            <?php echo $this->Form->input('Module.settings.smtp_password', array('type' => 'password', 'label' => 'SMTP password')); ?>
        <?php echo $this->Html->useTag('fieldsetend'); ?>
    </div>
<?php echo $this->Html->useTag('fieldsetend'); ?>