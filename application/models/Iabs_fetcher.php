<?php defined('BASEPATH') OR exit('Missed a step, right?');

	/**
	 * IABS data retriever
	 * @since 1.0
	*/

	class Iabs_Fetcher extends CI_Model {

		public function __construct() {
			parent::__construct();
		}

		public function fetch($type, $options) {
            if ($type == 'where' && is_array($options)) {
                $resource = $this->db->select($options['row'])
                ->where($options['where'], $options['value'])
                ->limit($options['limit'])
                ->get($options['table']);
            } else {
                if (is_array($options)) {
                    $this->db->select($options['row']);
                    $resource = $this->db->get($options['table']);
                }
            }

            if ($resource && $resource->num_rows() == 0) {
                return false;
            } else {
                return $resource;
            }
		}
	}
?>