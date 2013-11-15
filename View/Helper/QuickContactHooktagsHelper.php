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

		if ($noContact) {
			return '';
		} else {
			return $this->_View->element('QuickContact.user_form', array('username' => $user['User']['username']));
		}
	}	
}