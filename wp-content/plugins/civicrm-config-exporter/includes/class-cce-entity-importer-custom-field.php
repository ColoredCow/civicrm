<?php

class CCE_Entity_Importer_Custom_Field extends CCE_Entity_Importer {
	public function __construct() {
		parent::__construct('CustomField', 'custom_fields.json');
	}
}
