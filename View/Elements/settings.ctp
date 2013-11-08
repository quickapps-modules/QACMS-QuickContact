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
				'legend' => false,	
				'onclick' => 'toggleSMTPSettings();'
			)
		);
	?>

	<div id="smtp-settings" style="<?php echo $value == 'smtp' ? '' : 'display:none;'; ?>">
		<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'SMTP settings')); ?>
			<?php echo $this->Form->input('Module.settings.smtp_host', array('label' => 'SMTP host *')); ?>
			<?php echo $this->Form->input('Module.settings.smtp_port', array('label' => 'SMTP port *')); ?>
			<?php echo $this->Form->input('Module.settings.smtp_username', array('label' => 'SMTP user name *')); ?>
			<?php echo $this->Form->input('Module.settings.smtp_password', array('type' => 'password', 'label' => 'SMTP password *')); ?>
		<?php echo $this->Html->useTag('fieldsetend'); ?>
	</div>
<?php echo $this->Html->useTag('fieldsetend'); ?>

<!-- -->

<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'Security')); ?>
	<?php
		$value = !isset($this->data['Module']['settings']['use_captcha']) ? 'yes' : $this->data['Module']['settings']['use_captcha'];

		echo $this->Form->input('Module.settings.use_captcha',
			array(
				'type' => 'radio',
				'value' => $value,
				'options' => array(
					'yes' => __d('quick_contact', 'Use captcha protection (recommended)'),
					'no' => __d('quick_contact', 'Do not use captcha protection')
				),
				'separator' => '<br />',
				'legend' => false,
				'label' => false,
				'class' => 'captchar',
				'onclick' => 'toggleCaptchaSettings();'
			)
		);
	?>

	<div id="captcha-settings" style="<?php echo $value == 'yes' ? '' : 'display:none;'; ?>">
		<hr />
		<?php echo $this->Form->input('Module.settings.recaptcha.public_key', array('type' => 'text', 'label' => __d('quick_contact', 'ReCaptcha Public Key'))); ?>
		<?php echo $this->Form->input('Module.settings.recaptcha.private_key', array('type' => 'text', 'label' => __d('quick_contact', 'ReCaptcha Private Key'))); ?>
		<?php
			echo $this->Form->input('Module.settings.recaptcha.theme',
				array(
					'type' => 'select',
					'label' => __d('quick_contact', 'Theme'),
					'options' => array(
						'red' => __d('quick_contact', 'Red'),
						'white' => __d('quick_contact', 'White'),
						'blackglass' => __d('quick_contact', 'Black Glass'),
						'clean' => __d('quick_contact', 'Clean')
					)
				)
			);
		?>
		<?php
			echo $this->Form->input('Module.settings.recaptcha.lang',
				array(
					'type' => 'select',
					'label' => __d('quick_contact', 'Language'),
					'options' => array(
						'auto' => __d('quick_contact', 'Auto-Detect'),
						'en' => __d('quick_contact', 'English'),
						'nl' => __d('quick_contact', 'Dutch'),
						'fr' => __d('quick_contact', 'French'),
						'de' => __d('quick_contact', 'German'),
						'pt' => __d('quick_contact', 'Portuguese'),
						'ru' => __d('quick_contact', 'Russian'),
						'es' => __d('quick_contact', 'Spanish'),
						'tr' => __d('quick_contact', 'Turkish'),
						'custom' => __d('quick_contact', 'Custom Translation')
					),
					'onchange' => "if (this.value == 'custom') { $('#recaptcha_custom_lang').show(); } else { $('#recaptcha_custom_lang').hide(); } "
				)
			);
		?>
		<div id="recaptcha_custom_lang" style="<?php echo Configure::read('Modules.Comment.settings.recaptcha.lang') != 'custom' ? 'display:none;' : ''; ?>">
			<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'Custom Translation')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.instructions_visual', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.instructions_audio', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.play_again', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.cant_hear_this', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.visual_challenge', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.audio_challenge', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.refresh_btn', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.help_btn', array('type' => 'text')); ?>
				<?php echo $this->Form->input('Module.settings.recaptcha.custom_translations.incorrect_try_again', array('type' => 'text')); ?>
			<?php echo $this->Html->useTag('fieldsetend'); ?>
		</div>
	</div>	
<?php echo $this->Html->useTag('fieldsetend'); ?>

<!-- -->

<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'Terms of use')); ?>
	<?php
		$value = !isset($this->data['Module']['settings']['enable_terms_of_use']) ? 'no' : $this->data['Module']['settings']['enable_terms_of_use'];

		echo $this->Form->input('Module.settings.enable_terms_of_use',
			array(
				'type' => 'radio',
				'value' => $value,
				'options' => array(
					'yes' => __d('quick_contact', 'Enable term of use'),
					'no' => __d('quick_contact', 'Disable term of use')
				),
				'separator' => '<br />',
				'class' => 'tour',
				'label' => false,
				'legend' => false,
				'onclick' => 'toggleTOUSettings();'
			)
		);
	?>

	<div id="tou-settings" style="<?php echo $value == 'yes' ? '' : 'display:none;'; ?>">
		<?php echo $this->Html->useTag('fieldsetstart', __d('quick_contact', 'Terms of use settings')); ?>
			<?php
				echo $this->Form->input('Module.settings.terms_of_use_label',
					array(
						'type' => 'text',
						'label' => __d('quick_contact', 'Terms of use label *'),
						'helpBlock' => __d('quick_contact', 'The text shown next to the checkbox. e.g. "I have read and agree the terms"')
					)
				);
			?>
			<hr />
			<?php
				echo $this->Form->input('Module.settings.terms_of_use_title',
					array(
						'type' => 'text',
						'label' => __d('quick_contact', 'Terms of use title *'),
						'helpBlock' => __d('quick_contact', 'Title for the long text below. e.g. "Terms of Use"')
					)
				);

				echo $this->Form->input('Module.settings.terms_of_use_text',
					array(
						'type' => 'textarea',
						'label' => __d('quick_contact', 'Terms of use text *'),
						'helpBlock' => __d('quick_contact', 'The text users must read before submit the form.')
					)
				);
			?>
		<?php echo $this->Html->useTag('fieldsetend'); ?>
	</div>
<?php echo $this->Html->useTag('fieldsetend'); ?>

<script>
	function toggleSMTPSettings() {
		if ($('.transport-type:checked').val() == 'smtp') {
			$('#smtp-settings').show();
		} else {
			$('#smtp-settings').hide();
		} 
	}

	function toggleTOUSettings() {
		if ($('.tour:checked').val() == 'yes') {
			$('#tou-settings').show();
		} else {
			$('#tou-settings').hide();
		}
	}

	function toggleCaptchaSettings() {
		if ($('.captchar:checked').val() == 'yes') {
			$('#captcha-settings').show();
		} else {
			$('#captcha-settings').hide();
		}
	}
</script>