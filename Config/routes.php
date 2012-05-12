<?php
	Router::connect('/contact', array('plugin' => 'quick_contact', 'controller' => 'contact', 'action' => 'site_form'));
	Router::connect('/contact/:username', array('plugin' => 'quick_contact', 'controller' => 'contact', 'action' => 'user_form'), array('pass' => array('username')));