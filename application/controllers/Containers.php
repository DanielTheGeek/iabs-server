<?php
defined('BASEPATH') OR exit();

class Containers extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if (! file_exists(APPPATH.'config/iabs-config.php')) {
		   redirect();
		}
	}

	public function index()
	{
		$this->load->helper('array');
		$this->load->helper('text');

		$data = ($this->data) ? $this->data : '' ;
		$data['content'] = 'index';

		$tables = $this->db->list_tables();
		$data['table_colors'] = [
			'primary',
			'red',
			'green',
			'yellow'
		];

		$data['tables'] = $tables;
		$this->parser->parse('includes/template', $data);
	}

}