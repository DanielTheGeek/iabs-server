<?php
defined('BASEPATH') OR exit('Missed a step, right?');

	/**
	 * IABS Database Utility Model
	 * 
	 * @since 	1.0.0
	 * @author 	Daniel Omoniyi
	*/

	class Database_Utils extends CI_Model {

		/**
		 * Class constructor 
		 * 
		 * @since 1.0.0
		*/
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Adds a new record to the database table  
		 * 
		 * @param 	array - $options
		 * @return 	boolean
		 * @since 	1.0.0
		*/
		public function create( $options ) {
			// Check if $option is truly an array and contains the keys needed
			if ( is_array($options) && array_key_exists('data', $options) && array_key_exists('table', $options) ) {
				$response = $this->db->insert( $options['table'], $options['data'] );	

				return $response;
			} else {
				return false;
			}
		}

		/**
		 * Updates data existing in the database 
		 * 
		 * @param 	string - $type | array - $options
		 * @return 	boolean
		 * @since 	1.0.0
		*/
		public function update( $type='', $options ) {
			if (empty($type) || $type != 'where') {
				rename($type, $options);
			} elseif (! empty($type)) {
				$this->db->where($options['where'], $options['value']);
			} 
			$update = $this->db->update( $options['table'], $options['data'] );

			if ( $update ) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Deletes data from the database
		 * 
		 * @param
		 * @return 	boolean
		 * @since 	1.0.1
		*/
		public function delete( $options ) {
			
		}
	}
?>