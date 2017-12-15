<?php
defined('BASEPATH') OR exit();

	class Profile_Controller extends CI_Controller {
		/*
			Rango Studios profile controller:
			This controller is responsible for managing, sorting and displaying user data received from models 
		*/

		private $user;
		private $activities;

		public function __construct() {
			parent::__construct();
		}

		public function index($user) {
		}
	}	
?>