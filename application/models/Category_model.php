<?php

class Category_model extends CI_Model {

	public function getlistcat() {
	
			$this->db->select('*');
			$result = $this->db->get('category');
			$res = array();
			if($result->result()) {
				$res = $result->result();
			}
			return $res;
		
	}
	
	public function getlistcatdata($cat_id = NULL) {
		
		if($cat_id) {
			$this->db->select('*');
			$this->db->where('cat_id',$cat_id);
			$result = $this->db->get('category');
			$catdata = array();
			foreach($result->result() as $row) {
				$catdata = $row;
			}
				return $catdata;
		} else {
			return false;
		}
	}

	public function addcat($postcat) {
	
		if($postcat) {
			
			$catdata = array(
				'cat_name' => $postcat['cat_name'],
				'cat_desc' => $postcat['cat_desc'],
				'cat_image' => $postcat['cat_image'],
				'active' => $postcat['active'],
				'items' => $postcat['items'],
				'main_cat' => $postcat['main_cat'],
			);
			
			$result = $this->db->insert('category',$catdata);
			
			if($result) {
				return true;
			} else {
				return false;
			}
	
		} else {
			return false;
		}
	}
	
	public function editcat($data) {
	
	if($data) {
			
			if($data['cat_image']) {
				$cat = array(
					'cat_name' => $data['cat_name'],
					'cat_desc' => $data['cat_desc'],
					'cat_image' => $data['cat_image'],
					'active' => $data['active'],
					'items' => $data['items'],
					'main_cat' => $data['main_cat'],
				);
			} else {
				$cat = array(
					'cat_name' => $data['cat_name'],
					'cat_desc' => $data['cat_desc'],
					'active' => $data['active'],
					'items' => $data['items'],
					'main_cat' => $data['main_cat'],
				);	
			}	
			//echo $cat;
			$this->db->where('cat_id',$data['cat_id']);
			$res = $this->db->update('category',$cat);
			if($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}	
	
	}
	
	public function deletecat($cat_id,$cat_image) {
	
		if($cat_id) {
			
			$this->db->select('*');
			$this->db->where('cat_id',$cat_id);
			$result = $this->db->get('category');
			$cat_name = array();
			if($result->result()) {
				$cat_name = $result->result();
			} 
			
			$this->db->where('cat_id',$cat_id);
			$res = $this->db->delete('category');
			unlink("images/category/".$cat_name[0]->cat_image);
			
			if($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}
	
	public function fetch_data() {
		
		$this->db->select('*');
		//$this->db->where('cat_id',$cat_id);
		$result = $this->db->get('category');
		$cat_name = array();
		if($result->result()) {
			$cat_name = $result->result();
		}
		
		//foreach($result->result() as $row) {
		//		$cat_name = $row;
		//}
		echo "<pre>"; print_r($cat_name); echo $cat_name[0]->cat_name;
		echo "<pre>"; print_r(json_decode(json_encode($cat_name), true));
		echo $cat_name[0]->cat_name; die;
		return $cat_name[0];
	}	

}



?>