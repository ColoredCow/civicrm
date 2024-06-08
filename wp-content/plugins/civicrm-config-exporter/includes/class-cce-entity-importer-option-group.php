<?php

class CCE_Entity_Importer_Option_Group extends CCE_Entity_Importer {
	public function __construct() {
		parent::__construct('OptionGroup', 'option_groups.json');
	}
}
