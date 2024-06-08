<?php

class CCE_Entity_Importer_Custom_Group extends CCE_Entity_Importer {
	public function __construct() {
		parent::__construct('CustomGroup', 'custom_groups.json');
	}
}
