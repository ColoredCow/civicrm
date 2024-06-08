<?php

class CCE_Entity_Importer_Contact_Type extends CCE_Entity_Importer {
	public function __construct() {
		parent::__construct('ContactType', 'contact_types.json');
	}
}
