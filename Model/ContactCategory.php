<?php
class ContactCategory extends AppModel {
    public $useTable = 'qc_categories';
    public $validate = array(
        'name' => array('required' => true, 'allowEmpty' => false, 'rule' => 'notEmpty', 'message' => 'Category name field is required.'),
        'recipients' => array('required' => true,  'allowEmpty' => false, 'rule' => 'notEmpty', 'message' => 'Invalid recipients emails.')
    );
    
    public function beforeValidate($options = array()) {
        $recipients = $this->data['ContactCategory']['recipients'];
        $recipients = array_unique(explode(',', preg_replace('/\s/', '', $recipients)));
        $invalid = array();

        foreach ($recipients as $email) {
            if (!Validation::email($email)) {
                $invalid[] = $email;
            }
        }

        if (!empty($invalid)) {
            $this->validate['recipients']['message'] = __d('quick_contact', 'Invalid e-mail addresses: %s.', implode(', ', $invalid));
            $this->data['ContactCategory']['recipients'] = '';
        } else {
            $this->data['ContactCategory']['recipients'] = implode(',', $recipients);
        }
    }

    public function beforeSave() {
        if ($this->data['ContactCategory']['selected']) {
            $this->updateAll(array('ContactCategory.selected' => 0));
        }
    }
}