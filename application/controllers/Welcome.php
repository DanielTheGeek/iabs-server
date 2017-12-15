<?php
defined('BASEPATH') OR exit();

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->data = [];

		if (file_exists(APPPATH.'config/iabs-config.php')) {
			// Load admin model
			$this->load->model('iabs_admin', 'admin');

			// Required model
			$this->load->model('iabs_base_model', 'core');
			$this->load->model('iabs_fetcher', 'fetcher');

			$this->options = array(
				'row'		=>		'option_value',
				'table'		=>		'options',
				'where'		=>		'option_name',
				'value'		=>		'site_name',
				'limit'		=>		1
			);
			$this->fetch = $this->fetcher->fetch('where', $this->options);

			if ($this->fetch) {
				$this->data = array(
			      	'page_title' 	=> 	'Dashboard',
			      	'site_name'		=>		$this->fetch->row()->option_value
		      	);
			}
		} else {
			redirect('ignite');
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
			'yellow',
		];

		$get = $this->db->get('plugins');
		$plugins = '';
		if ($get) {
			$plugins = $get->num_rows();
		}

		$data['tables'] = $tables;
		$data['plugins'] = $plugins;
		$this->parser->parse('includes/template', $data);
	}
}
