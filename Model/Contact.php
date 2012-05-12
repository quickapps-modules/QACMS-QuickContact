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
}