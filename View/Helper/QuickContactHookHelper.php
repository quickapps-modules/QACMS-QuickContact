<?php
class QuickContactHookHelper extends AppHelper {
	public function html_nested_list_alter(&$params) {
		if (QuickApps::is('view.user_profile') &&
			isset($params['options']['id']) &&
			$params['options']['id'] == 'user-profile-menu'
		) {
			$r = Router::getParams();

			if (isset($r['pass'][0])) {
				if (QuickApps::is('user.admin')) {
					// show always contact button to admins
					$params['list'][] = $this->_View->Html->link(__d('quick_contact', 'Contact'), '/contact/' . $r['pass'][0]);
				} else {
					if ($user = ClassRegistry::init('User.User')->findByUsername($r['pass'][0])) {
						$contact_form = Set::extract('/Field[name=field_user_contact_form]/FieldData', $user);

						if (count($contact_form) === 1) {
							$contact_form = $contact_form[0]['FieldData']['data'];

							if ($contact_form === 'yes') {
								$params['list'][] = $this->_View->Html->link(__d('quick_contact', 'Contact'), '/contact/' . $r['pass'][0]);
							}
						}
					}
				}
			}
		}
	}
}