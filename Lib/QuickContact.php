<?php
class QuickContact {
	public static function termsOfUseEnabled() {
		$enable_terms_of_use = strtolower(trim(Configure::read('Modules.QuickContact.settings.enable_terms_of_use'))) == 'yes' ? true : false;
		$terms_of_use_label = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_label'));
		$terms_of_use_title = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_title'));
		$terms_of_use_text = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_text'));

		return $enable_terms_of_use && !empty($terms_of_use_label) && !empty($terms_of_use_title) && !empty($terms_of_use_text);
	}

	public static function captchaEnabled() {
		$use_captcha = strtolower(trim(Configure::read('Modules.QuickContact.settings.use_captcha'))) == 'yes' ? true : false;
		$public_key = trim(Configure::read('Modules.QuickContact.settings.recaptcha.public_key'));
		$private_key = trim(Configure::read('Modules.QuickContact.settings.recaptcha.private_key'));

		return $use_captcha && !empty($public_key) && !empty($private_key);
	}
}