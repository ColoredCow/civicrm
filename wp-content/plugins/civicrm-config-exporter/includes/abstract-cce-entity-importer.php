<?php

abstract class CCE_Entity_Importer {
    protected $entity;
    protected $filename;

    public function __construct($entity, $filename) {
        $this->entity = $entity;
        $this->filename = $filename;
    }

    public function run() {
        $upload_dir = wp_upload_dir();
        $file_path = $upload_dir['basedir'] . '/civi-config-exports/' . $this->filename;

        if (!file_exists($file_path)) {
            return ucfirst($this->entity) . " import failed: file {$this->filename} not found.";
        }

        $json = file_get_contents($file_path);
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return ucfirst($this->entity) . " import failed: invalid JSON in {$this->filename}.";
        }

        foreach ($data as $item) {
            try {
                $result = civicrm_api3($this->entity, 'create', ["values" => $item]);
                if ($result['is_error']) {
                    return "API error ({$this->entity}): " . $result['error_message'];
                }
            } catch (CiviCRM_API3_Exception $e) {
                return "API error ({$this->entity}): " . $e->getMessage() . '<br />' . $e->getTraceAsString();
            }
        }

        return ucfirst($this->entity) . " imported successfully from {$this->filename}.";
    }
}
