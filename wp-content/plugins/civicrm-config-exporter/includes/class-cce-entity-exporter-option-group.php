<?php

class CCE_Entity_Exporter_Option_Group extends CCE_Entity_Exporter {
	public function __construct() {
		parent::__construct('OptionGroup', 'option_groups.json');
	}
}
