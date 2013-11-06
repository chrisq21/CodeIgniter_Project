<?php

class User_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    function get_user($email) {
    	$query = $this->db->get_where('users', array('email' => $email));
        if(isset($query->result()[0]))
    	   return $query->result()[0];
        else 
            return NULL;
    }

    function get_user_byid($id) {
        $query = $this->db->get_where('users', array('id' => $id));
        if(isset($query->result()[0]))
           return $query->result()[0];
        else 
            return NULL;
    }

    function insert_user($user) {
        $this->db->insert('users', $user);
    }

    function delete_user($id) {
        $this->db->delete('users', array('id' => $id));
    }

    function update_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data); 
    }

    function email_exists($email) {
    	$query = $this->db->get_where('users',  array('email' => $email));
    	if(count($query->result()) > 0)
    		return TRUE;
    	else 
    		return FALSE;
    }    
}

//end of file