<?php
class QuickContactHookComponent extends Component {
	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
		QuickApps::addDetector('QuickContact.termsOfUseEnabled', array('QuickContact', 'termsOfUseEnabled'));
		QuickApps::addDetector('QuickContact.captchaEnabled', array('QuickContact', 'captchaEnabled'));		
	}
}