<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
	
	public function __construct() {
	
		parent::__construct();
		$this->load->model('user_model');
		
	}
	
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$data = "";
		
		//$data['user'] = $this->user_model->getUserList();
		//$this->template->write('title', 'Category : Add Category');
		$this->template->write_view('contain_area', 'user/index');
		
		$this->template->render();
		
	}
	
	public function view_user()
	{
		$data = "";
		
		$data = $this->user_model->getUserList();
		
		echo json_encode($data);
		
		//$this->template->write_view('contain_area', 'user/index', $data, TRUE);
		
		//$this->template->render();
		
	}
	
	public function add($id = NULL) {
		$data = "";
		
		//$this->load->model('user_model');
		
		if(!empty($id)) {
			
			$data['user'] = $this->user_model->getUserDetail($id);
			
			if($this->input->post()) {
				$postdata = $this->input->post();
				
				$result = $this->user_model->editUser($postdata);
				
				if($result) {
					redirect(base_url().'index.php/user/');
				} else {
					redirect(base_url().'index.php/user/add/'.$id);
				}
			}
				
		} else {
		
			if($this->input->post()) {
				
				$postdata = $this->input->post();
				
				$this->form_validation->set_rules('firstname', 'Firstname', 'required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'required');
				$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[20]');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
				
				if ($this->form_validation->run() == FALSE) {
					 $this->session->set_flashdata('error', validation_errors());
					redirect(base_url().'index.php/user/add'); 
				} else {
				
				$result = $this->user_model->addUser($postdata);
				
				if($result) {
					$this->session->set_flashdata('success', "User added successfully.");
					
					redirect(base_url().'index.php/user/index'); 
					
				}
				}
				
			}
		}
		//echo "<pre>"; print_r($data); die;
		$this->template->write_view('contain_area', 'user/add', $data, TRUE);
		
		$this->template->render();
	}
	
	public function getListing() {
		
		//$this->load->model('user_model');
		
		$data = $this->user_model->getListing();
		
		echo json_encode($data);
		
		die;
			
	}
	
	public function addNewUser() {
		
		$data = file_get_contents("php://input");
		
		$userdata = json_decode($data);
		
		$this->load->model('user_model');
		
		$result = $this->user_model->addNewUser($userdata);
		
		//$data = $this->user_model->getListing();
		
		echo json_encode($result);
		
		
		
		die;
		
	}
	
	public function delete($id = NULL) {
		if($id) {
			
			$this->load->model('user_model');
			
			$result = $this->user_model->deleteUser($id); 
			
			if($result) {
				
				redirect(base_url().'index.php/user/');
			}
			
		} else {
			redirect(base_url().'index.php/user/');
		}	
	}
	
}
