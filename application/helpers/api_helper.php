<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('remove_unknown_fields')){
	function remove_unknown_fields($row_data, $expected_fields) {
		$new_data = array();
		foreach ($row_data as $field_name => $field_value) {
			if($field_value !='' && in_array($field_name, array_values($expected_fields))){
				$new_data[$field_name] = $field_value;
			}
		}
		return $new_data; 
	}
}
