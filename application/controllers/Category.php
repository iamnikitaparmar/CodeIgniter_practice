<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	

	public function index() {
			
		$this->load->helper('comman_helper');
		//$data="";
		$this->load->view('category/index');
		//$this->load->model('category_model');
		
		//$data['catdata']=$this->category_model->getlistcat();
		
		//echo json_encode($data);
		//$this->load->view('category/index',json_encode($data));
	
	}
	
	public function view_cat() {
	
		$data="";
		
		$this->load->model('category_model');
		
		$data=$this->category_model->getlistcat();
		
		echo json_encode($data);
		
		//$this->load->view('category/index',json_encode($data));
	
	}

	public function add($cat_id = NULL) {
		
		$data="";
		
		$this->load->model('category_model');
		
		if(!empty($cat_id)) {
		
			$data['catdata'] = $this->category_model->getlistcatdata($cat_id);
			
			if($this->input->post()) {
				
				$postcat = $this->input->post();
				
				if(isset($postcat['items']) && !empty($postcat['items'])) {
					$postcat['items'] = implode(",",$postcat['items']);
				} else {
					$postcat['items'] = "";
				}
				
				if($_FILES['cat_image']) {
					$cat_image = $_FILES['cat_image']['name'];
					move_uploaded_file($_FILES['cat_image']['tmp_name'],"images/category/".$cat_image);
					$postcat['cat_image'] = $cat_image;
				}
				//echo "<pre>"; print_r($postcat); die;
				$this->form_validation->set_rules('cat_name','Category Name','trim|required');
				$this->form_validation->set_rules('cat_desc','Category Description','trim|required');
				$this->form_validation->set_rules('active','Active','required');
				
				if($this->form_validation->run() == false) {
					
						$this->session->set_flashdata('error',validation_errors());
						redirect(base_url().'index.php/category/add/'.$cat_id);
						
				} else {
					
					$result = $this->category_model->editcat($postcat);
					if($result) {
						$this->session->set_flashdata('success','Successfully update category');
						redirect(base_url().'index.php/category/');
					}
				}
				
				if($result) {
					redirect(base_url().'index.php/category/');
				} else {
					redirect(base_url().'index.php/category/add/',$cat_id);
				}
			
			}
		
		} else {
		
			if($this->input->post()) {
			
				$postcat = $this->input->post();
				
				if(isset($postcat['items']) && !empty($postcat['items'])) {
					$postcat['items'] = implode(",",$postcat['items']);
				} else {
					$postcat['items'] = "";
				}	
				
				
				if($_FILES['cat_image']) {
					$cat_image = $_FILES['cat_image']['name'];
					move_uploaded_file($_FILES['cat_image']['tmp_name'],"images/category/".$cat_image);
					$postcat['cat_image'] = $cat_image;
				}	
				
				$this->form_validation->set_rules('cat_name','Category Name','trim|required');
				$this->form_validation->set_rules('cat_desc','Category Description','trim|required');
				$this->form_validation->set_rules('active','Active','required');
				
					if($this->form_validation->run() == false) {
					
						$this->session->set_flashdata('error',validation_errors());
						redirect(base_url().'index.php/category/add');
						
					} else {
					
					$result = $this->category_model->addcat($postcat);
					if($result) {
						$this->session->set_flashdata('success','Successfully add category');
						redirect(base_url().'index.php/category/');
						}
					}
			
			}
		
		}
		
		$this->load->view('category/add',$data);
	}
	
	public function delete() {
		
		if ($this->input->is_ajax_request()) {

				$cat_id = $this->input->post('cat_id');
				$cat_image = $this->input->post('cat_image');

			
			$this->load->model('category_model');
			
			$res = $this->category_model->deletecat($cat_id,$cat_image);
			
			/*if($res) {
				//print_r($res); die;
				redirect(base_url().'index.php/category/');
			} */
			
		} /*else {
			
			redirect(base_url().'index.php/category/');
		} */
	
	
	}

	public function fetch() {
		
		$this->load->model('category_model');
		$res = $this->category_model->fetch_data();
		//$array = json_decode(json_encode($res), true);
		echo $res->cat_image;
		echo "<pre>"; print_r($array); die;
	}	
	
}





?>