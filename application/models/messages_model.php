<?php

class Messages_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function add_message($message_data) {
        $this->db->insert('messages', $message_data);
    }

    function delete_messages($id) {
        $this->db->delete('messages', array('profile_id' => $id));
        $this->db->delete('messages', array('user_id' => $id));
    }

    function get_messages_byid($id) {
        $this->db->select('users.first_name, users.last_name, messages.id, messages.message, messages.created_at');
        $this->db->from('messages');
        $this->db->join('users', 'users.id = messages.user_id');
        $this->db->where('profile_id', $id);
        $this->db->order_by('messages.id DESC');
        $query = $this->db->get();
        // $query = $this->db->get_where('messages', array('profile_id' => $id))->result();
        return $query->result();
    }

}

//end of file