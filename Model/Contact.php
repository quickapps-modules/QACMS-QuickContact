<?php
class Contact extends AppModel {
	public $useTable = false;
	public $validate = array(
		'name' => array('required' => true, 'allowEmpty' => false, 'rule' => 'notEmpty', 'message' => 'Your name field is required.'),
		'email' => array('required' => true, 'allowEmpty' => false, 'rule' => 'email', 'message' => 'Your e-mail address field is required.'),
		'subject' => array('required' => true, 'allowEmpty' => false, 'rule' => 'notEmpty', 'message' => 'Subject field is required.'),
		'category' => array('required' => true, 'allowEmpty' => false, 'rule' => 'numeric', 'message' => 'You must select a valid category.'),
		'message' => array('required' => true, 'allowEmpty' => false, 'rule' => 'notEmpty', 'message' => 'Message field is required.')
	);

	public function beforeValidate() {
		$return = true;

		if (QuickApps::is('QuickContact.captchaEnabled')) {
			if (!defined('RECAPTCHA_API_SERVER')) {
				App::import('Lib', 'Comment.Recaptcha');
			}

			$recaptcha = recaptcha_check_answer(
				Configure::read('Modules.QuickContact.settings.recaptcha.private_key'),
				env('REMOTE_ADDR'),
				$this->data['Contact']['recaptcha_challenge_field'],
				$this->data['Contact']['recaptcha_response_field']
			);

			if (!$recaptcha->is_valid) {
				CakeSession::write('invalid_recaptcha', true);
				$this->invalidate('recaptcha_response_field', __d('quick_contact', 'Invalid security code.'));
				$return = false;
			}
		}

		if (QuickApps::is('QuickContact.termsOfUseEnabled')) {
			if (!isset($this->data['Contact']['terms_of_use']) || $this->data['Contact']['terms_of_use'] != '1') {
				$this->invalidate('terms_of_use', __d('quick_contact', 'You must agree the terms of use.'));
				$return = false;
			}
		}

		return $return;
	}
}