<?php	
if (!defined('RECAPTCHA_API_SERVER')) {
	App::import('Lib', 'Comment.Recaptcha');
}

$RecaptchaOptions = '';
$settings = Hash::merge(
	array(
		'custom_translations' => array(
			'instructions_visual' => '',
			'instructions_audio' => '',
			'play_again' => '',
			'cant_hear_this' => '',
			'visual_challenge' => '',
			'audio_challenge' => '',
			'refresh_btn' => '',
			'help_btn' => '',
			'incorrect_try_again' => ''
		),
		'lang' => 'en',
		'theme' => 'red'
	), Configure::read('Modules.QuickContact.settings.recaptcha')
);

switch ($settings['lang']) {
	case 'auto':
		$L10n = new L10n;
		$langs = $L10n->map();
		$language_code = 'en';

		if (isset($langs[Configure::read('Variable.language.code')]) &&
			in_array($langs[Configure::read('Variable.language.code')], array('en', 'nl', 'fr', 'de', 'pt', 'ru', 'es', 'tr'))
		) {
			$language_code = $langs[Configure::read('Variable.language.code')];
		}

		$RecaptchaOptions .= "lang: '{$language_code}',";
	break;

	case 'custom':
		$RecaptchaOptions .= 'custom_translations: {';
		$strings = array();

		foreach ($settings['custom_translations'] as $key => $str) {
			if (empty($str)) {
				continue;
			}

			$strings[] = "{$key}: '" . str_replace("'", "\'", $str) . "'";
		}

		$RecaptchaOptions .= implode(",\n", $strings);
		$RecaptchaOptions .= '},';
	break;

	default:
		$RecaptchaOptions .= "lang: '{$settings['lang']}',";
	break;
}

$RecaptchaOptions .= "theme: '{$settings['theme']}'";
?>

<div class="input text required <?php echo (CakeSession::read('invalid_recaptcha') ? 'error' : ''); ?>">
	<script type="text/javascript">
		var RecaptchaOptions = {
			<?php echo $RecaptchaOptions; ?>
		};
	</script>
	<?php echo recaptcha_get_html(Configure::read('Modules.QuickContact.settings.recaptcha.public_key')); ?>
	<?php if (CakeSession::read('invalid_recaptcha')): ?>
		<div class="error-message"><?php echo __d('quick_contact', 'Invalid security code.'); ?></div>
		<?php CakeSession::write('invalid_recaptcha' ,false); ?>
	<?php endif; ?>
</div>