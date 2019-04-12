<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	
		$data = "";
		
		
		$this->template->write_view('contain_area', 'dashboard/index', $data, TRUE);
		
		$this->template->render();
		
	}
	
	
	
}
