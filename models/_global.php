<?php

class Model {
	protected $db_dir;
	public $name;

	public function __construct() {
		global $OCCU_CONFIG;
		$this->db_dir = $OCCU_CONFIG['db_dir'];
		$this->name = get_class($this);
	}

	/**
	 * Loads one or more entries from the database.
	 * @var $field_name If set along with $field_values, gets only entries that match $field_values on $field_name
	 * @var $field_values If set along with $field_name, gets only entries that match $field_values on $field_name
	 * @return Mixed - object if a single item was found, or array of entries
	 */
	public function load($field_name = NULL, $field_values = NULL) {
		$table_data = $this->_load_table($this->name);
		$entries = array();
		if ($field_name && $field_values) {
			if (!is_array($field_values)) $field_values = array($field_values);
			foreach ($field_values as $field_value) {
				foreach ($table_data as $index => $entry) {
					if ($entry->$field_name == $field_value) {
						$entries[] = $entry;
					}
				}
			}
			if (!empty($entries)) {
				if (count($entries) == 1) return $entries[0];
				return $entries;
			} else {
				return FALSE;
			}
		}
		return $table_data;
	}

	/**
	 * Saves data to the database
	 *
	 * @var $data Data to save
	 * @var $new_data Set to true to perform validation that we aren't adding an already existing unique key
	 */	
	public function save($data, $new_data = FALSE) {
		$table_data = $this->_load_table($this->name);
		$update_index = FALSE;
		$index = 0;
		
		// Validate required fields, if any
		if (isset($this->required)) {
			foreach ($this->required as $required_field_name) {
				foreach ($table_data as $index => $entry) {
					if ($entry->$required_field_name == $data[$required_field_name]) {
						if ($new_data) {
							return FALSE;
						}
						// If we're not saving new data, we want to overwrite the data that's there
						$table_data->$index = $data;
						$update_index = TRUE;
					}
				}
			}
		}
		// If we didn't find it's already in the data, add a new entry for it
		$index += 1;
		if (!$update_index) $table_data->$index = $data;
		
		return $this->_save_table($table_data);
	}
	
	/**
	 * Delete an entry from the database
	 */	
	public function delete($field_name, $field_value) {
		$table_data = $this->_load_table($this->name);
		$success = FALSE;
		foreach ($table_data as $index => $entry) {
			if ($entry->$field_name == $field_value) {
				unset($table_data->$index);
				$success = TRUE;
				break;
			}
		}
		$this->_save_table($table_data);
		return $success;
	}

	/**
	 * Loads a table from the database (In this case, a JSON file)
	 */
	protected function _load_table() {
		$table_contents = file_get_contents($this->db_dir . '/' . strtolower($this->name) . '.json');
		return json_decode($table_contents);
	}

	/**
	 * Saves a table to the database (In this case, a JSON file) with all of its values
	 */
	protected function _save_table($table_data) {
		$table_encoded_data = json_encode($table_data);
		return file_put_contents($this->db_dir . '/' . strtolower($this->name) . '.json', $table_encoded_data, LOCK_EX);
	}
}