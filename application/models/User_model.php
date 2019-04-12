<?php

class User_model extends CI_Model {

	public function getUserList() {
		
		$this->db->select('*');
		$this->db->order_by('id','ASC');
		$query = $this->db->get('user');
		$user = array();
		if($query->result()) {
			$user = $query->result();
		}
		
		return $user;
		
	}
	
	public function getListing() {
		
		$this->db->select('*');
		$query = $this->db->get('user');
		$user = array();
		if($query->result()) {
			$user = $query->result();
		}
		
		return $user;
		
	}
	
	public function addUser($data) {
		if($data) {
			
		$user = array(
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'username' => $data['username'],
			'email' => $data['email'],
		);
		$res = $this->db->insert('user',$user);		
		if($res) {
			return true;
		} else {
			return false;
		}
		} else {
			return false;
		}
 	}
	
	
	public function addNewUser($data) {
		if($data) {
			
		$user = array(
			'firstname' => $data->firstname,
			'lastname' => $data->lastname,
			'username' => $data->username,
			'email' => $data->email,
		);
		$res = $this->db->insert('user',$user);		
		if($res) {
			return true;
		} else {
			return false;
		}
		} else {
			return false;
		}
 	}
	
	public function getUserDetail($id = NULL) {
		if($id) {
			$this->db->select('*');
			$this->db->where('id',$id);
			$result = $this->db->get('user');
			$user = array();
			foreach($result->result() as $row) {
				$user = $row;
			}
			return $user;
		} else {
			return false;
		}	
	}
	
	public function editUser($data) {
		if($data) {
			
			$user = array(
				'firstname' => $data['firstname'],
				'lastname' => $data['lastname'],
				'username' => $data['username'],
				'email' => $data['email'],
			);
			$this->db->where('id',$data['user_id']);
			$res = $this->db->update('user',$user);
			if($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}	
	}
	/**
	*  deleteUser()
	*  description :this function is to delete the user
	*  params: $id (int)
	*  Author : Chirag 
	*  Date : 07-05-2017	
	*/
	public function deleteUser($id) {
		
		if($id) {
			$this->db->where('id',$id);
			$res = $this->db->delete('user');
			if($res) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}

}
