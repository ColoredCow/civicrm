<?php

abstract class CCE_Entity_Exporter {
	protected $entity;
	protected $filename;

	public function __construct($entity, $filename) {
		$this->entity = $entity;
		$this->filename = $filename;
	}

	public function run() {
		try {
			$result = civicrm_api3($this->entity, 'get', ['sequential' => 1]);
			if (!empty($result['values'])) {
				$json = json_encode($result['values'], JSON_PRETTY_PRINT);

				$upload_dir = wp_upload_dir();
				$export_dir = $upload_dir['basedir'] . '/civi-config-exports';
				if (!file_exists($export_dir)) {
					mkdir($export_dir, 0755, true);
				}
				$file_path = $export_dir . '/' . $this->filename;
				file_put_contents($file_path, $json);

				return ucfirst($this->entity) . " exported successfully to {$this->filename}.";
			}
		} catch (CiviCRM_API3_Exception $e) {
			return "API error ({$this->entity}): " . $e->getMessage();
		}
		return "No {$this->entity} found to export.";
	}
}
