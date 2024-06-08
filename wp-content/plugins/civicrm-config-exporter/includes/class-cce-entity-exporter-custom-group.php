<?php

class CCE_Entity_Exporter_Custom_Group extends CCE_Entity_Exporter {
	public function __construct() {
		parent::__construct('CustomGroup', 'custom_groups.json');
	}
}
