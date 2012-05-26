<?php
class ContactController extends AppController {
	public $uses = array('QuickContact.Contact', 'QuickContact.ContactCategory');

	public function admin_categories() {
		$categories = $this->ContactCategory->find('all');

		$this->set('results', $categories);
		$this->title(__d('quick_contact', 'Contact types'));
		$this->setCrumb('/admin/quick_contact/contact/categories');
	}

	public function admin_category_add() {
		if (isset($this->data['ContactCategory'])) {
			if ($this->ContactCategory->save($this->data)) {
				$this->flashMsg(__d('quick_contact', 'Category has been created'), 'success');
				$this->redirect('/admin/quick_contact/contact/categories');
			} else {
				$this->flashMsg(__d('quick_contact', 'Category could not be saved'), 'error');
			}
		}

		$this->title(__d('quick_contact', 'Add new category'));
		$this->setCrumb('/admin/quick_contact/contact/categories');
	}

	public function admin_category_edit($id) {
		if (isset($this->data['ContactCategory'])) {
			if ($this->ContactCategory->save($this->data['ContactCategory'])) {
				$this->flashMsg(__d('quick_contact', 'Category has been saved'));
			} else {
				 $this->flashMsg(__d('quick_contact', 'Category could not be saved'), 'error');
			}
		}

		$this->data = $this->ContactCategory->findById($id) or $this->referer('/admin/quick_contact/contact/categories');

		$this->setCrumb('/admin/quick_contact/contact/categories');
	}

	public function admin_category_delete($id) {
		$this->ContactCategory->delete($id);
		$this->flashMsg(__d('quick_contact', 'Category has been deleted'), 'success');
		$this->redirect($this->referer());
	}

	public function site_form() {
		$this->__doForm();

	}

	public function user_form($username) {
		$this->__doForm($username);
	}

	private function __doForm($username = false) {
		if ($username) {
			$noContact = false;

			if ($user = ClassRegistry::init('User.User')->findByUsername($username)) {
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
				$this->redirect('/');
			} else {
				$this->set('username', $username);
			}
		}

		if (isset($this->data['Contact'])) {
			$this->Contact->set($this->data);

			if (!$this->Contact->validates()) {
				$errors = array_values($this->Contact->invalidFields());

				$this->flashMsg(implode('<br />', $errors), 'error');
			} else {
				App::uses('CakeEmail', 'Network/Email');

				$category = $this->ContactCategory->findById($this->data['Contact']['category']);
				$recipients = $username ? array($user['User']['email']) : explode(',', $category['ContactCategory']['recipients']);
				$email = $this->__emailClass();

				$email->from(Configure::read('Variable.site_mail'), Configure::read('Variable.site_name'))
				->sender(Configure::read('Variable.site_mail'), Configure::read('Variable.site_name'))
				->replyTo($this->data['Contact']['email'], $this->data['Contact']['name'])
				->subject($this->data['Contact']['subject']);

				foreach ($recipients as $bcc) {
					$email->addBcc($bcc);
				}

				if ($this->data['Contact']['copy']) {
					$email->addCc($this->data['Contact']['email']);
				}

				$sent = $email->send($this->data['Contact']['message']);

				if ($sent) {
					if (!empty($category['ContactCategory']['reply'])) {
						$email = $this->__emailClass();

						$email->from(Configure::read('Variable.site_mail'), Configure::read('Variable.site_name'))
						->sender(Configure::read('Variable.site_mail'), Configure::read('Variable.site_name'))
						->replyTo(Configure::read('Variable.site_mail'), Configure::read('Variable.site_name'))
						->subject(__d('quick_contact', 'Contact message confirmation'))
						->to($this->data['Contact']['email'], $this->data['Contact']['name'])
						->send($category['ContactCategory']['reply']);
					}

					$this->flashMsg(__d('quick_contact', 'Your message has been sent.'), 'success');
					$this->redirect($this->referer());
				} else {
					$this->flashMsg(__d('quick_contact', 'Unable to send e-mail. Contact the site administrator if the problem persists.'), 'error');
				}
			}
		}

		$selected = $this->ContactCategory->find('first', array('conditions' => array('ContactCategory.selected' => 1)));

		$this->title('Contact');
		$this->set('categories', $this->ContactCategory->find('list'));
		$this->set('selected', @$selected['ContactCategory']['id']);
	}

	private function __emailClass() {
		if (Configure::read('Modules.QuickContact.settings.transport') == 'smtp') {
			// SMTP
			$email = new CakeEmail(
				array(
					'host' => Configure::read('Modules.QuickContact.settings.smtp_host'),
					'port' => Configure::read('Modules.QuickContact.settings.smtp_port'),
					'username' => Configure::read('Modules.QuickContact.settings.smtp_username'),
					'password' => Configure::read('Modules.QuickContact.settings.smtp_password'),
					'transport' => 'Smtp'
				)
			);
		} else {
			// PHP mail()
			$email = new CakeEmail();
		}

		return $email;
	}
}