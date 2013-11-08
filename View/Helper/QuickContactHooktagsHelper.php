<?php
class QuickContactHooktagsHelper extends AppHelper {
	public function site_contact_form($attr, $content = null, $code = '') {
		if (!empty($content)) { // selfclosing format only: [site_contact_form /]
			return '';
		}

		$selected = ClassRegistry::init('QuickContact.ContactCategory')->find('first', array('conditions' => array('ContactCategory.selected' => 1)));
		$args = array(
			'categories' => ClassRegistry::init('QuickContact.ContactCategory')->find('list'),
			'selected' => @$selected['ContactCategory']['id']
		);

		$this->__termsOfUseEnabled();
		$this->__captchaEnabled();
		return $this->_View->element('QuickContact.site_form', $args);
	}

	public function user_contact_form($attr, $content = null, $code = '') {
		$noContact = false;

		if (!empty($content) || !isset($attr['user'])) { // selfclosing format only: [user_contact_form user=username /]
			return '';
		}

		if (intval($attr['user']) > 0) { // ID given
			$conditions = array(
				'User.id' => intval($attr['user'])
			);
		} else { // username given
			$conditions = array(
				'User.username' => $attr['user']
			);
		}

		$user = ClassRegistry::init('User.User')->find('first', array('conditions' => $conditions));

		if ($user) {
			if (!QuickApps::is('user.admin')) {
				$contact_form = Set::extract('/Field[name=field_user_contact_form]/FieldData', $user);

				if (count($contact_form) === 1) {
					$contact_form = $contact_form[0]['FieldData']['data'];
					$noContact = $contact_form !== 'yes';
				} else {
					$noContact = true;
				}
			}
		} else {
			$noContact = true;
		}

		$this->__termsOfUseEnabled();
		$this->__captchaEnabled();

		if ($noContact) {
			return '';
		} else {
			return $this->_View->element('QuickContact.user_form', array('username' => $user['User']['username']));
		}
	}
	
	private function __termsOfUseEnabled() {
		$enable_terms_of_use = strtolower(Configure::read('Modules.QuickContact.settings.enable_terms_of_use')) == 'yes' ? true : false;
		$terms_of_use_label = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_label'));
		$terms_of_use_title = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_title'));
		$terms_of_use_text = trim(Configure::read('Modules.QuickContact.settings.terms_of_use_text'));
		$return = $enable_terms_of_use && !empty($terms_of_use_label) && !empty($terms_of_use_title) && !empty($terms_of_use_text);

		$this->_View->set('__termsOfUseEnabled', $return);

		return $return;
	}

	private function __captchaEnabled() {
		$use_captcha = strtolower(trim(Configure::read('Modules.QuickContact.settings.use_captcha'))) == 'yes' ? true : false;
		$public_key = trim(Configure::read('Modules.QuickContact.settings.recaptcha.public_key'));
		$private_key = trim(Configure::read('Modules.QuickContact.settings.recaptcha.public_key'));
		$return = $use_captcha && !empty($public_key) && !empty($private_key);

		$this->_View->set('__captchaEnabled', $return);
		
		return $return;
	}	
}